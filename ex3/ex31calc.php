<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1     {text-align: center;}
        h3     {color: #444444;}
        .cell  {text-align: center; vertical-align: middle;}
        .great {text-align: center; vertical-align: middle; color: #1565C0;}
        .good  {text-align: center; vertical-align: middle; color: #2E7D32;}
        .mid   {text-align: center; vertical-align: middle; color: #B58900;}
        .bad   {text-align: center; vertical-align: middle; color: #C62828;}
    </style>
    <title>Exercise 3.1</title>
</head>
<body>
    <h1> Exercise 3.1 </h1>

    <?php
        $total = $_POST["total"];
        $class = "";

        if ($total >= 3000){
            $discount = 0.2;
            $class = "great";
        } 
        elseif ($total >= 2000){
            $discount = 0.15;
            $class = "good";
        } 
        elseif ($total >= 1000){
            $discount = 0.1;
            $class = "mid";
        }
        else{
            $discount = 0;
            $class = "bad";
        }

        $totalDiscounted = $total*$discount;
        $finalValue = $total - $totalDiscounted;
        
        $displayDiscount = round($discount * 100);
        $displayTotal = number_format($total, 2);
        $displayTotalDiscounted = number_format($totalDiscounted,2);
        $displayFinalValue = number_format($finalValue, 2);

        print "<table border='0'>";
        print "<tr>
                    <td class='cell'>
                        <strong>Original amount:
                    </td>
                    <td class='cell'>
                        &euro; $displayTotal
                    </td>
                </tr>";
        print "<tr class='$class'>
                    <td> 
                        <strong>$displayDiscount% discount:
                    </td>
                    <td>
                        &euro; $displayTotalDiscounted
                    </td>
                </tr>";
        print "<tr>
                    <td class='cell'>
                        <strong>Total to pay:
                    </td>
                    <td class='cell'>
                        &euro; $displayFinalValue
                    </td>
                </tr>";
        print "</table>";

        print "<p>";

        echo "<button onclick='history.back()'>Back</button>";
    ?>
    
    
</body>
</html>