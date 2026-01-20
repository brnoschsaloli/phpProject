<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
    </style>
    <title>Exercise 3.2</title>
</head>
<body>
    <h1> Exercise 3.2</h1>
    <h3> If you put an amount of money on a bank account and the interest rate is fixed. How much do you get back after x years? </h3>


    <form action="ex32.php" method="POST">
        <label for="org">Money amount you invest:</label>
        <input type="text" id="org" name="org" required>
        <p>
        <label for="rate">Interest rate (use e.g. 7 to represent 7%):</label>
        <input type="text" id="rate" name="rate" required>
        <p>
        <label for="year">The number of years you want to keep the money on the account:</label>
        <input type="text" id="year" name="year" required>
        <p>
        <input type="hidden" name="calc" value="1">
        <button type="submit"><strong>Calculate</button>
        <p>
    </form>

    <?php
        $org = $_POST["org"];
        
        $rate = $_POST["rate"];
        $ratep = $rate/100;
        $year = $_POST["year"];
        $calc = $_POST["calc"];

        $res = number_format($org * pow(1 + $ratep, $year), 2);
        if ($calc == 1){
            print "<p>If you invest <strong>&euro;$org</strong>, and the interest rate is <strong>$rate%</strong>, you'll receive <strong>&euro;$res</strong> after <strong>$year</strong> years.</p>";
            echo "<button onclick='history.back()'><strong>Start over</button>";
        }
        
    ?> 
    
    
</body>
</html>