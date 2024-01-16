<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<h1>Parameters and returns</h1>
    <?php 
        function sum($n1 = 0, $n2 = 0, ...$n3) {
            $tot = 0;
            foreach ($n3 as $number) {
                $tot += $number;
            }
            $value_1 =  $n1 * $tot;
            $value_2 = $tot / $n2;
            return [$value_1, $value_2];
        };

        [$value_1, $value_2 ] = sum(2, 3, 5, 5, 5);
        echo $value_1, '</br>';
        echo $value_2, '</br>';

        $values = sum(2, 3, 10, 10, 10);
        echo $values[0], '</br>';
        echo $values[1], '</br>';
    ?>
<h1>Functions at a variable, and anonymous</h1>
<?php 
    function ResultRendering($n1, $n2, $UserValue = 'add') { 
        function CalcFunctionForAdd($x, $y) {return $x + $y;};
        function CalcFunctionForMultiply($x, $y) {return $x * $y;};
        function CalcFunctionForSubtract($x, $y) {return $x - $y;};
        

        $calc = match ($UserValue) {
            'add' => 'CalcFunctionForAdd',
            'mul' => 'CalcFunctionForMultiply',
            'sub' => 'CalcFunctionForSubtract',
        };
        echo $calc($n1, $n2), '<br/>';
    };
    ResultRendering(3, 2, 'mul');


    
    echo preg_replace_callback( //encontra um trecho da string e aplica a função
        '~-([a-z])~', // Econtra o W e remove o - antes dele

        function ($match) { // Anonymous function
            return strtoupper($match[1]);
        }, 'hello-world');
    

    $Var_fc = fn($x, $v) => $v + $x;
    echo $Var_fc(2, 8);
?>
</body>
</html>