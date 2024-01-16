<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Precedencia</h1>
<?php
    $precedencia = 2 + 3 * (3 - 1);
    echo $precedencia, "<br/>";
?>
<h1>Aritméticos</h1>
<?php 
    $a = 4;
    echo -$a, "<br/>";
    $b = '12.5';
    var_dump(+$b); 
    echo '<br/>';
    echo $a + $b, "<br/>";
    echo $a - $b, "<br/>";
    echo $a * $b, "<br/>";
    echo $a / $b, "<br/>";
    echo $a % $b, "<br/>";
    echo $a ** $b, "<br/>";
?>
<h1>Comparação</h1>
<?php 
    
?>
</body>
</html>