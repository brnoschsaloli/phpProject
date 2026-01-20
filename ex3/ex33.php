<!-- this file is created by Breno Oliveira -->
<html>
<head>
    <style>
        h1 {text-align: center;}
        h3 {color: #444444;}
        .cell  {text-align: center; vertical-align: middle;padding:5}
    </style>
    <title>Exercise 3.3</title>
</head>
<body>
    <h1> Exercise 3.3</h1>

    <?php
        
        $collection = array(
            
            // titulo => preco

            "ao vivo" => 500,
            
            "dos predio" => 200,
             
            "porque elas preferem os canalhas" => 300,
                
            "evom" => 50,
            
            "mixtape supernova vol.1" => 100,
                
        );

        ksort($collection);
        print "<table border='2' align='center'>";
        foreach($collection as $title => $value){
            print "<tr>
                        <td class='cell'>
                            <strong>$title
                        </td>
                        <td class='cell'>
                            &euro; $value
                        </td>
                    </tr>";
        }
        print "</table>";
        
        print"<p>";

        print "<table border='2' align='center'>";
        asort($collection);
        foreach($collection as $title => $value){
            print "<tr>
                        <td class='cell'>
                            <strong>$title
                        </td>
                        <td class='cell'>
                            &euro; $value
                        </td>
                    </tr>";
        }
        print "</table>";


       
        
    ?>
    
    
</body>
</html>