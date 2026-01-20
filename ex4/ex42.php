<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
        .cell  {text-align: center; vertical-align: middle;padding:5}
    </style>
    <title>Exercise 4.2</title>
</head>
<body>
    <h1> Exercise 4.2</h1>


    <form action="ex42.php" method="POST">
        <label for="budget">Budget:</label>
        <input type="text" id="budget" name="budget" required>
        <p>
        <input type="hidden" name="calc" value="1">
        <button type="submit"><strong>Calculate</button>
        <p>
    </form>

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

        $budget = $_POST["budget"];
        $budget = floatval($budget);
        $calc = $_POST["calc"];

        
        
        $queryBudget = "
            SELECT 
                * 
            FROM 
                `cdtable`
            WHERE
                `price` < $budget";

        $idBudget = $mydb->query($queryBudget);

        

        if ($calc == 1){
            

            print "<p><strong>Affordable content:</p>";
            print "<table border='1' align='center'>";
            print "<tr>";
            print "<td><strong>Artist</td>";
            print "<td><strong>Album</td>";
            print "<td><strong>Price</td>";
            print "</tr>";
            while ($row = mysqli_fetch_row($idBudget)){
                print "<tr>";
                for ($field=1; $field < mysqli_num_fields($idBudget); $field++){
                    print "<td style='text-align: center; vertical-align: middle;padding:5px;'>";
                    print "$row[$field]";
                    print "</td>";
                }
                print"</tr>";
            }
            print"</table>";
            print"<p>";
            print "<button onclick='history.back()'><strong>Start over</button>";
        } 
        
    ?>
    
    
</body>
</html>