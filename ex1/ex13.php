<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <title>Exercise 1.3</title>
</head>
<body>
    <?php 
        $firstName = "Breno";
        $lastName = "Schneider";
        $street = "Rua Trinta e Um de Março";
        $number = "404";
        $zip = "05657-030";
        $city = "São Paulo";
        $name = $firstName . " " . $lastName;
        $address1 = $street . " " . $number;
        $address2 = $zip . " " . $city;
    ?>
     
    <h1> Exercise 1.3 </h1>
    
    <?php 
        print "<p>$firstName $lastName <br>$street $number</br> $zip $city</p>";
        print "<p>$name <br>$address1</br> $address2</p>"
    ?>

</body>
</html> 