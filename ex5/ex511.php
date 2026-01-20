<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
        .cell  {text-align: center; vertical-align: middle;padding:5}
    </style>
    <title>Exercise 5.1</title>
</head>
<body>
    <h1> Exercise 5.1</h1>

    <?php

        $dbUser = 'breno';
        $dbPassword = 'gator-zoe-PIONEER-cramped';
        $database = $dbUser . "_db";
        $mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("morreu");
        
        
        $queryAll = "
            SELECT 
                * 
            FROM 
                `cdtable`";
        
        $idAll = $mydb->query($queryAll);
        

        print "<p><strong>All content:</p>";
        print "<table border='1' align='center'>";
        print "<tr>";
        print "<td><strong>Artist</td>";
        print "<td><strong>Album</td>";
        print "<td><strong>Price</td>";
        print "</tr>";
        while ($row = mysqli_fetch_row($idAll)){
            print "<tr>";
            for ($field=1; $field < mysqli_num_fields($idAll); $field++){
                print "<td style=' text-align: center; vertical-align: middle;padding:5px;'>";
                print "$row[$field]";
                print "</td>";
            } 
            print"</tr>";
        }
        print"</table>";

        print "<p>";

        print "<button onclick='history.back()'><strong>Back</button>";
    ?>
    
    
</body>
</html>