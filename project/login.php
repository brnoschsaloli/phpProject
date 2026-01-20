<!-- this file is created by Breno Oliveira -->
<?php
require_once "auth.php";

$dbUser = 'breno';
$dbPassword = 'gator-zoe-PIONEER-cramped';
$database = $dbUser . "_db";
$mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("DB error");

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $mydb->prepare("SELECT id, username, password_hash, display_name FROM calendarOwnerTable WHERE id = 1 LIMIT 1");
    $stmt->execute();
    $res = $stmt->get_result();
    $owner = $res->fetch_assoc();

    if ($owner && hash_equals($owner['username'], $username) && password_verify($password, $owner['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['owner_logged_in'] = true;
        $_SESSION['owner_username'] = $owner['username'];
        $_SESSION['owner_display_name'] = $owner['display_name'] ?? $owner['username'];

        header("Location: main.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Owner login</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Owner login</h2>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form method="POST" style="max-width:360px;">
        <label>Username</label><br>
        <input type="text" name="username" required style="width:100%;"><br><br>

        <label>Password</label><br>
        <input type="password" name="password" required style="width:100%;"><br><br>

        <button class="btn" type="submit">Login</button>
        <a class="btn secondary" href="main.php">Cancel</a>
    </form>
</body>

</html>