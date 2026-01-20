<!-- this file is created by Breno Oliveira -->
<?php
require_once "auth.php";
require_login();

$dbUser = 'breno';
$dbPassword = 'gator-zoe-PIONEER-cramped';
$database = $dbUser . "_db";
$mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("DB error");

$stmt = $mydb->prepare("SELECT username, display_name, email FROM calendarOwnerTable WHERE id = 1 LIMIT 1");
$stmt->execute();
$owner = $stmt->get_result()->fetch_assoc();
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Owner</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="owner-nav">
        <a href="main.php">← Back</a>
        <h2>Owner</h2>
        <a href="logout.php">Logout</a>
    </div>

    <p></p>

    <div class="sidebar" style="max-width:520px;">
        <p><b>Name:</b>
            <?= htmlspecialchars($owner['display_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </p>
        <p><b>Username:</b>
            <?= htmlspecialchars($owner['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </p>
        <p><b>Email:</b>
            <?= htmlspecialchars($owner['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
        </p>
    </div>
</body>

</html>