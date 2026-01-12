<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
    </style>
    <title>Exercise 2.4</title>
</head>
<body>
    <h1> Exercise 2.4 </h1>
    <h3> If you put an amount of money on a bank account and the interest rate is fixed. How much do you get back after 5, 10 and 15 years? </h3>

    <?php
        $org = $_POST["org"];
        $rate = $_POST["rate"];
        $ratep = $rate/100;

        $res5 = number_format($org * pow(1 + $ratep, 5), 2);
        $res10 = number_format($org * pow(1 + $ratep, 10), 2);
        $res15 = number_format($org * pow(1 + $ratep, 15), 2);

        print "<p>If you invest <strong>&euro;$org</strong>, and the interest rate is <strong>$rate%</strong>, you'll receive these payouts:</p>";

        print "<table width='200' border='1'>";
        print "<tr><th>Years</th><th>Amount (in &euro;)</th></tr>";
        print "<tr><td>5</td><td>$res5</td></tr>";
        print "<tr><td>10</td><td>$res10</td></tr>";
        print "<tr><td>15</td><td>$res15</td></tr>";
        print "</table>";

        print "<p>";

        echo "<button onclick='history.back()'>Back</button>";
    ?>
    
    
</body>
</html>