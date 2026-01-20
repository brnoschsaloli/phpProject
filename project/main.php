<?php
// main.php

$dbUser = 'breno';
$dbPassword = 'gator-zoe-PIONEER-cramped';
$database = $dbUser . "_db";
$mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("error");


// categories
$allCategories = [];
$catRes = $mydb->query("
  SELECT DISTINCT category
  FROM calendarTable
  WHERE category IS NOT NULL AND category <> '' AND `date` >= CURDATE()
  ORDER BY category ASC
");
if ($catRes) {
  while ($c = $catRes->fetch_assoc()) {
    $allCategories[] = $c['category'];
  }
}

// add event
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_event'])) {

  $event_name = trim($_POST['event_name'] ?? '');
  $date = $_POST['date'] ?? '';           // YYYY-MM-DD
  $date_time = $_POST['date_time'] ?? '';      // HH:MM or empty
  $category = trim($_POST['category'] ?? '');
  $description = trim($_POST['description'] ?? '');

  // Basic validation
  if ($event_name !== '' && $category !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) { // regex for nnnn-nn-nn

    // empty time -> NULL
    $timeOrNull = ($date_time === '') ? null : $date_time;
    $descOrNull = ($description === '') ? null : $description;

    $query = "INSERT INTO calendarTable (`event_name`, `date`, `date_time`, `category`, `description`)
                VALUES (?, ?, ?, ?, ?)";
    $stmt = $mydb->prepare($query);

    // s = string, we can bind NULL too
    $stmt->bind_param("sssss", $event_name, $date, $timeOrNull, $category, $descOrNull);
    $ok = $stmt->execute();
    if ($ok) {
      print "<p style='color:green'>New event successfully added!</p>";
    } else {
      print "<p style='color:red'>Error: " . $stmt->error . "</p>";
    }
  }

  header("Location: main.php"); // prevent duplicate insert
  exit; // stops php
}


// Read month/year from URL, default to current month/year
$month = isset($_GET['m']) ? (int) $_GET['m'] : (int) date('n');
$year = isset($_GET['y']) ? (int) $_GET['y'] : (int) date('Y');

// Basic safety bounds
if ($month < 1)
  $month = 1;
if ($month > 12)
  $month = 12;
if ($year < 1970)
  $year = 1970;
if ($year > 2100)
  $year = 2100;

$search = trim($_GET['q'] ?? '');                 // search text
$selectedCats = $_GET['cat'] ?? [];              // cat[]=Work&cat[]=School

$qs = [
  'q' => $search,
];

foreach ($selectedCats as $cat) {
  $qs['cat'][] = $cat;
}

$filterQuery = http_build_query($qs);

if (!is_array($selectedCats))
  $selectedCats = [];
$selectedCats = array_values(array_filter(array_map('trim', $selectedCats)));

$firstDayTimestamp = mktime(0, 0, 0, $month, 1, $year);
$daysInMonth = (int) date('t', $firstDayTimestamp);     // number of days in month
$firstWeekday = (int) date('N', $firstDayTimestamp);    // 1=Mon ... 7=Sun

// Previous / next month links
$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
  $prevMonth = 12;
  $prevYear--;
}

$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
  $nextMonth = 1;
  $nextYear++;
}

$monthName = date('F', $firstDayTimestamp);
$todayY = (int) date('Y');
$todayM = (int) date('n');
$todayD = (int) date('j');


$start = sprintf('%04d-%02d-01', $year, $month);
$endTs = mktime(0, 0, 0, $month + 1, 1, $year); // first day of next month
$end = date('Y-m-d', $endTs);

$query = "
  SELECT event_id, event_name, `date`, date_time, category, description
  FROM calendarTable
  WHERE `date` >= ? AND `date` < ?
";

$params = [$start, $end];
$types = "ss";

// category filter
if (count($selectedCats) > 0) {
  $placeholders = implode(',', array_fill(0, count($selectedCats), '?'));
  $query .= " AND category IN ($placeholders)";
  $types .= str_repeat("s", count($selectedCats));
  foreach ($selectedCats as $c)
    $params[] = $c;
}

// name search
if ($search !== '') {
  $query .= " AND event_name LIKE ?";
  $types .= "s";
  $params[] = "%" . $search . "%";
}

$query .= " ORDER BY `date` ASC, date_time ASC";

$stmt = $mydb->prepare($query);
$stmt->bind_param($types, ...$params); // ...$params is the same as $params[0], $params[1], ...
$ok = $stmt->execute();

if ($ok) {
  $eventsByDay = [];
  $result = $stmt->get_result();
  while ($row = $result->fetch_assoc()) { // fetch_assoc return the data in a associative array
    $eventDay = (int) substr($row['date'], 8, 2); // day number 0123-56-89
    $eventMonth = (int) substr($row['date'], 5, 2);
    $eventYear = (int) substr($row['date'], 0, 4);
    $eventTime = mktime(0, 0, 0, $eventMonth, $eventDay, $eventYear);
    $todayTime = mktime(0, 0, 0, $todayM, $todayD, $todayY);
    if ($eventTime >= $todayTime) { // sees if the event is in the future
      $eventsByDay[$eventDay][] = $row; // [] appends to the empty array
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>PHP Dynamic Calendar</title>
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <div class="layout">
    <aside class="sidebar">
      <form method="GET" class="filter-form">
        <input type="hidden" name="m" value="<?= (int) $month ?>">
        <input type="hidden" name="y" value="<?= (int) $year ?>">

        <h3>Filters</h3>

        <label for="q">Search</label>
        <input id="q" type="text" name="q" value="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8') ?>"
          placeholder="Event name...">

        <div class="cats">
          <div class="cats-title">Categories</div>

          <?php foreach ($allCategories as $cat):
            $checked = in_array($cat, $selectedCats, true);
            ?>
            <label class="cat-item">
              <input type="checkbox" name="cat[]" value="<?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>" <?= $checked ? 'checked' : '' ?>>
              <span><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></span>
            </label>
          <?php endforeach; ?>
        </div>

        <button type="submit" class="btn">Apply</button>

        <a class="btn secondary" href="main.php?m=<?= (int) $month ?>&y=<?= (int) $year ?>">Clear</a>
      </form>
    </aside>

    <main class="content">
      <div class="nav">
        <a href="?m=<?= $prevMonth ?>&y=<?= $prevYear ?>&<?= $filterQuery ? '&' . $filterQuery : '' ?>">&larr; Prev</a>
        <h2><?= htmlspecialchars($monthName) ?> <?= $year ?></h2>
        <a href="?m=<?= $nextMonth ?>&y=<?= $nextYear ?>&<?= $filterQuery ? '&' . $filterQuery : '' ?>">Next &rarr;</a>
      </div>

      <a class="add-btn"
        href="addEvent.php?m=<?= $month ?>&y=<?= $year ?>&<?= $filterQuery ? '&' . $filterQuery : '' ?>">+ Add event</a>

      <table>
        <thead>
          <tr>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php
            // Print leading empty cells
            for ($i = 1; $i < $firstWeekday; $i++) {
              print '<td class="empty"></td>';
            }

            // Print all days
            $weekday = $firstWeekday;
            for ($day = 1; $day <= $daysInMonth; $day++) {
              $isToday = ($year === $todayY && $month === $todayM && $day === $todayD);
              $cls = $isToday ? 'today' : ''; // cls = 'today' if isToday == 1 or '' if isToday == 0
            
              print "<td class=\"$cls\"><div class='daynum'>$day</div>";

              //print events
              if (!empty($eventsByDay[$day])) {
                echo "<ul class='event-list'>";

                foreach ($eventsByDay[$day] as $ev) {
                  $time = $ev['date_time']
                    ? "<span class='event-time'>" . substr($ev['date_time'], 0, 5) . "</span>"
                    : "";

                  $categoryClass = strtolower($ev['category']);
                  $id = (int) $ev['event_id'];

                  $link = "event.php?id=$id&m=" . urlencode($month) . "&y=" . urlencode($year);

                  echo "<li class='event-item $categoryClass'>"
                    . "<a class='event-link' href='$link'>"
                    . $time
                    . htmlspecialchars($ev['event_name'], ENT_QUOTES, 'UTF-8')
                    . "</a>"
                    . "</li>";
                }

                echo "</ul>";
              }

              echo "</td>";

              if ($weekday === 7 && $day !== $daysInMonth) {
                print "</tr><tr>";
                $weekday = 1;
              } else {
                $weekday++;
              }
            }

            // Print trailing empty cells
            if ($weekday !== 1) {
              for ($i = $weekday; $i <= 7; $i++) {
                print '<td class="empty"></td>';
              }
            }
            ?>
          </tr>
        </tbody>
      </table>
    </main>
  </div>



</body>

</html>