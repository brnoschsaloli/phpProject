<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
    </style>
    <title>Exercise 2.3</title>
</head>
<body>
    <h1> Exercise 2.3 </h1>
    <h3> If you put an amount of money on a bank account and the interest rate is fixed. How much do you get back after x years? </h3>

    <?php
        $org = $_POST["org"];
        $rate = $_POST["rate"];
        $ratep = $rate/100;
        $year = $_POST["year"];

        $res = number_format($org * pow(1 + $ratep, $year), 2);

        print "<p>If you invest <strong>&euro;$org</strong>, and the interest rate is <strong>$rate%</strong>, you'll receive <strong>&euro;$res</strong> after <strong>$year</strong> years.</p>";

        echo "<button onclick='history.back()'>Back</button>";
    ?>
    
    
</body>
</html>