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

    <form action="ex24calc.php" method="POST">
        <label for="org">Money amount you invest:</label>
        <input type="text" id="org" name="org" required>
        <p>
        <label for="rate">Interest rate (use e.g. 7 to represent 7%):</label>
        <input type="text" id="rate" name="rate" required>
        <p>
        <button type="submit"><strong>Send</button>
        <p>
        <button type="reset"><strong>Start over</button>
    </form>
    
    
</body> 
</html>