<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #00ffd5;}
        .cell  {text-align: center; vertical-align: middle;padding:5}
    </style>
    <title>Exercise 3.4</title>
</head>
<body>
    <h1> Exercise 3.4</h1>

    <?php
        
        print "<table border='1' align='center'>";
        for ($i=1; $i<=10; $i++){
            print "<tr>";
            for ($j=1; $j<=10; $j++){
                $res = $j * $i;

                if ($res < 10){
                    $color = "0$res";
                }
                elseif ($res == 100){
                    $color = substr($res-1,-2);
                }
                else{
                    $color = $res;
                }
                print "<td style='color: #ffffff;background-color:#$color" . "00$color; text-align: center; vertical-align: middle;padding:5px;'>";
                print "<strong>$res";
                print "</td>";
            }
            print"</tr>";
        }
        print "</table>";

    ?>
    
    
</body>
</html>