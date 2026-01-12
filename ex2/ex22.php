<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <title>Exercise 2.2</title>
</head>
<body>
    <h1> Exercise 2.2 </h1>
    <?php
        $org = 100;
        $rate = 7;
        $ratep = $rate/100;
        $year = 10;

        $res = number_format($org * pow(1 + $ratep, $year), 2);

        print "<p>If you invest &euro;$org, and the interest rate is $rate%, you'll receive &euro;$res after $year years.</p>"
    ?>
    
    
</body>
</html>