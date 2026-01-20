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
        $mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("morreu");
        
        $queryTeto = "
            INSERT INTO 
                `cdtable` (`artist`, `title`, `price`)
            VALUES
                ('Teto', 'Maior que o tempo', 500);";

        $querySelect = "
            SELECT  
                * 
            FROM 
                `cdtable`";

        $result_id = $mydb->query($querySelect);


        while ($row = mysqli_fetch_row($result_id)){
            for ($field=0; $field < mysqli_num_fields($result_id); $field++){
                echo "$row[$field]\t";
            }
            echo "\n";
        }

        // ja foi feito

        // $result = $mydb->query($query);
    ?>
    
    
</body>
</html>