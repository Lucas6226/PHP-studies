<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Another control structures</h1>
<?php
    // declarer whit ticks parameter
    function br($um = '', $dois = '') 
    {
        echo $um, "<br/>", $dois;
    }
    
    register_tick_function("br");
    declare(ticks=2) {
    
        echo 'a';
        echo 'b';
        echo 'a';
        echo 'b';
        echo 'a';
        echo 'b';    
        echo 'a';
        echo 'b';    
        echo 'a';
        echo 'b';    
        echo 'a';
        echo 'b';
    }
    $a = 1;
    $b = 2;

    //require, include and *_once

    // require('requirer.php');
    require('require.php');
    
    include('include.php');

    require_once('require.php');
    include_once('include.php');

    
    //goto

    goto Test;
    echo 'this mensage will not be seen';
    Test:

?>
<h1>Conditional Sctructures</h1>
<?php 
    // if and else
    if ($a > $b) {
        echo 'maior';
    } elseif ($a < $b) {
        echo 'menor';
    } else {
        echo 'igual';
    }
    br();


    // switch
    $NumeroDoPedido = 2;
    switch ($NumeroDoPedido) {
        case 0:
            echo '0';
            break;
        case 1:
            echo '1';
            break;
        case 2:
            echo '2';
            break;
        case 3:
            echo '3';
            break;
        case 4:
            echo '4';
            break;
    }
    br();

    // match 
    $pedido = 'pizza';
    $pedido = match ($pedido) {
        'bolo' =>'pedido de bolo',
        'torta' => 'pedido de torta',
        'suco' => 'pedido de suco',
        'pizza' => 'pedido de pizza',
    };
    echo $pedido;
    br();
?>
<h1>Loops Structures</h1>
<?php 
    $str = 'Texto de exemplo para testar o while';
    $resultado = '';

    br(um: '0 to 20 with while: ');
    $count = 0;
    while ($count < 20) {
        $count++;
        if ($count == 9) {
            continue;
        } else if ($count == 17) {
            break;
        }
        echo $count, ' -> ';
    };
    br();


    $counter = 0;
    do {
        $counter == 7 ? $mensagem = 'ultimo numero: ': $mensagem = 'Numero: ';
        echo $mensagem, $counter++, '</br>';


    } while ($counter < 8);

    for ($i = 1; $i < 10; $i++) {
        echo 'Loadding: ', $i, '</br>';
    };
?>
</body>
</html>