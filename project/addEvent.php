<!-- this file is created by Breno Oliveira -->
<?php

require_once "auth.php"; // User login check    


/* ---------------------------
        DB CONNECTION
--------------------------- */
$dbUser = 'breno';
$dbPassword = 'gator-zoe-PIONEER-cramped';
$database = $dbUser . "_db";
$mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database)
    or die("DB error");



/* ------------------------------
    GET CATEGORIES FOR SELECT
----------------------------- */
$categories = [];
$catRes = $mydb->query("
    SELECT DISTINCT category 
    FROM calendarTable 
    WHERE category IS NOT NULL AND category <> '' 
    ORDER BY category ASC
");                              //not equal == <>


if ($catRes) {
    while ($c = $catRes->fetch_assoc()) {
        $categories[] = $c['category'];
    }
}


/* ------------------------------
    GET MONTH AND YEAR FROM URL
-------------------------------- */
$m = $_GET['m'] ?? '';
$y = $_GET['y'] ?? '';



/* ------------------------------
    ADD EVENT AFTER POST FORM
-------------------------------- */
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
        preg_match('/^\d{4}-\d{2}-\d{2}$/', $date) //regex to identify dates
    ) {

        $timeOrNull = ($date_time === '') ? null : $date_time; // check if datetime is not defined and define as NULL if it is
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

    header("Location: main.php?m=" . urlencode($m) . "&y=" . urlencode($y)); // redirect to main.php
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

    <div class="page">

        <h2>Add event</h2>

        <form method="POST" action="addEvent.php" style="max-width:520px;">

            <input type="hidden" name="m" value="<?= $_GET['m'] ?? '' ?>">
            <input type="hidden" name="y" value="<?= $_GET['y'] ?? '' ?>">

            <label>Date</label><br>
            <input type="date" name="date" style="width:50%;" required><br><br>

            <label>Time (optional)</label><br>
            <input type="time" name="date_time" style="width:50%;"><br><br>

            <label>Event name</label><br>
            <input type="text" name="event_name" style="width:50%;" required><br><br>

            <label for="category">Category</label><br>
            <input type="text" id="category" name="category" list="categoryList" required placeholder="Start typing..."
                style="width:50%;">

            <datalist id="categoryList">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?>"></option>
                <?php endforeach; ?>
            </datalist>
            <br><br>



            <label>Description</label><br>
            <textarea name="description" style="width:50%;"></textarea><br><br>

            <button type="submit">Save</button>

        </form>

        <p></p>

        <a href="main.php?m=<?= urlencode($m) ?>&y=<?= urlencode($y) ?>">← Back to calendar</a>

    </div>

</body>

</html>