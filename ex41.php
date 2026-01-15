<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
    </style>
    <title>Exercise 4.1</title>
</head>
<body>
    <h1> Exercise 4.1</h1>

    <?php
        
        $dbUser = 'breno';
        $dbPassword = 'gator-zoe-PIONEER-cramped';
        $database = $dbUser . "_db";
        $mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("No connection!");
        

        $query = "
            INSERT INTO 
                `cdtable` (`artist`, `title`, `price`)
            VALUES
                ('Teto', 'Maior que o tempo', 500);";

        $result = $mydb->query($query);
    ?>
    
    
</body>
</html>