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

    <form action="ex23calc.php" method="POST">
        <label for="org">Money amount you invest:</label>
        <input type="text" id="org" name="org" required>
        <p>
        <label for="rate">Interest rate (use e.g. 7 to represent 7%):</label>
        <input type="text" id="rate" name="rate" required>
        <p>
        <label for="year">The number of years you want to keep the money on the account:</label>
        <input type="text" id="year" name="year" required>
        <p>
        <button type="submit"><strong>Send</button>
        <p>
        <button type="reset"><strong>Start over</button>
    </form>
     
    
</body>
</html>