<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiny PHP course page for YOUR NAME HERE</title>
    <style>
        html { color-scheme: light dark; }
        body { font-family: System UI, sans-serif; font-size: 1.25rem; line-height: 1.5; }
        img,
        svg,
        video { max-width: 100%; display: block; }
        main { max-width: min(70ch, 100% - 4 rem); margin-inline: auto; }
        h1 { color: #333; }
        .info { background: #f5f5f5; padding: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>Welcome to the personal course page of Breno Schneider</h1>
    <div class="info">
        <p><strong>Server Time:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Your Username:</strong> <?php echo get_current_user(); ?></p>
    </div>
    <h2>Database Connection Test</h2>
    <div class="info">
        <?php
            // Update with your credentials
            $host = 'localhost';
            $dbname = get_current_user() . '_db';
            $user = get_current_user();
            $pass = 'gator-zoe-PIONEER-cramped';
            
            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
                echo "<p style='color:green'>✓ Database connection successful!</p>";
            } catch (PDOException $e) {
                echo "<p style='color:red'>✗ Connection failed. Update your credentials in index.php</p>";
            }
        ?>
    </div>
    <p>
    <details>
        <summary>Exercise 1</summary>
        <ul>
            <li><a href="ex11.php">exercise 1.1</a></li>
            <li><a href="ex12.php">exercise 1.2</a></li>
            <li><a href="ex13.php">exercise 1.3</a></li>
        </ul>
    </details>
    <details>
        <summary>Exercise 2</summary>
        <ul>
            <li><a href="ex21.php">exercise 2.1</a></li>
            <li><a href="ex22.php">exercise 2.2</a></li>
            <li><a href="ex23form.php">exercise 2.3 form</a></li>
            <li><a href="ex23calc.php">exercise 2.3 calculation</a></li>
            <li><a href="ex24form.php">exercise 2.4 form</a></li>
            <li><a href="ex24calc.php">exercise 2.4 calculation</a></li>
        </ul>
    </details>
</body>
</html>

