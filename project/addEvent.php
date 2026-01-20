<?php
$dbUser = 'breno';
$dbPassword = 'gator-zoe-PIONEER-cramped';
$database = $dbUser . "_db";
$mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database)
    or die("DB error");

$categories = [];
//category not equal ''
$catRes = $mydb->query("
    SELECT DISTINCT category 
    FROM calendarTable 
    WHERE category IS NOT NULL AND category <> '' 
    ORDER BY category ASC
");
if ($catRes) {
    while ($c = $catRes->fetch_assoc()) {
        $categories[] = $c['category'];
    }
}


$m = $_GET['m'] ?? '';
$y = $_GET['y'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $event_name = trim($_POST['event_name'] ?? '');
    $date = $_POST['date'] ?? '';
    $date_time = $_POST['date_time'] ?? '';
    $category = trim($_POST['category'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $m = $_POST['m'] ?? '';
    $y = $_POST['y'] ?? '';

    if (
        $event_name !== '' &&
        $category !== '' &&
        preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)
    ) {

        $timeOrNull = ($date_time === '') ? null : $date_time;
        $descOrNull = ($description === '') ? null : $description;

        $stmt = $mydb->prepare(
            "INSERT INTO calendarTable
            (`event_name`, `date`, `date_time`, `category`, `description`)
            VALUES (?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "sssss",
            $event_name,
            $date,
            $timeOrNull,
            $category,
            $descOrNull
        );

        $stmt->execute();
    }

    header("Location: main.php?m=" . urlencode($m) . "&y=" . urlencode($y));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <h2>Add event</h2>

    <form method="POST" action="addEvent.php" style="max-width:520px;">

        <input type="hidden" name="m" value="<?= $_GET['m'] ?? '' ?>">
        <input type="hidden" name="y" value="<?= $_GET['y'] ?? '' ?>">

        <label>Date</label><br>
        <input type="date" name="date" required><br><br>

        <label>Time (optional)</label><br>
        <input type="time" name="date_time"><br><br>

        <label>Event name</label><br>
        <input type="text" name="event_name" required><br><br>

        <label for="category">Category</label><br>
        <input type="text" id="category" name="category" list="categoryList" required placeholder="Start typing..."
            style="width:100%;">

        <datalist id="categoryList">
            <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>"></option>
            <?php endforeach; ?>
        </datalist>
        <br><br>



        <label>Description</label><br>
        <textarea name="description"></textarea><br><br>

        <button type="submit">Save</button>

    </form>

    <a href="main.php?m=<?= urlencode($m) ?>&y=<?= urlencode($y) ?>">← Back to calendar</a>

</body>

</html>