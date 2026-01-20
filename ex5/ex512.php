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


    <form action="ex512.php" method="POST">
        <label for="artist">Artist:</label>
        <input type="text" id="artist" name="artist" required>
        <p>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <p>
        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>
        <p>
        <input type="hidden" name="calc" value="1">
        <button type="submit"><strong>Store in Database</button>
        <button type="button" onclick='history.back()'><strong>Back</button>
        <p>
    </form>

    <?php

        $dbUser = 'breno';
        $dbPassword = 'gator-zoe-PIONEER-cramped';
        $database = $dbUser . "_db";
        $mydb = mysqli_connect('localhost', $dbUser, $dbPassword, $database) or die("morreu");
        

        // or = ??
        $calc = $_POST["calc"] ?? 0;
        
        if ($calc == 1){

            $artist = $_POST["artist"] ?? "";
            $title = $_POST["title"] ?? "";
            $price = $_POST["price"] ?? "0";

            $queryInsert = "INSERT INTO cdtable (artist, title, price) VALUES (?, ?, ?);";

            $stmt = $mydb->prepare($queryInsert);
            $stmt->bind_param("ssd", $artist, $title, $price); // s=string d=float (double) 
            $ok = $stmt->execute();
            if ($ok) {
                print "<p style='color:green'>New CD successfully added!</p>";
            } else {
                print "<p style='color:red'>Error: " . $stmt->error . "</p>";
            }

            print "<button onclick='history.back()'><strong>Try again</button>";
            print "<a href='ex51main.php'>";
                print "<button><strong>Main Menu</button>";
            print "</a>";


        }
        
    ?> 
    
    
</body>
</html>