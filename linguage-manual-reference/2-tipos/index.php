<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        // declarando variaveis e tipos principais 
        $int = 1;
        $float = 2.5;
        $str = "string";
        $bool = false;

        echo var_dump($int);
        echo var_dump($float);
        echo var_dump($str);
        echo var_dump($bool), "<br>";


        // opções de bases numericas para int 
        $varNull = NULL;
        $hexa = 0x1A;
        $octa = 0o123;
        $bi = 0b11111111;
        $deci = 1_234_567; // com caracteres alphanumericos
        echo $hexa, "<br>",  
            $octa, "<br>", 
            $bi, "<br>",
            $deci, "<br>";


        //limite de tamanho para variaveis
        $milion = 10000000;
        $bigNumber = $milion * 5000000000000;
        echo var_dump($bigNumber), "<br>";


        // objetos
        $lista = array("maçã", "laranja", "koolaid1" => "roxo"); // array e objeto
        $nomes = array("jane", "robert", "john"); // array 

        class objeto {
            public $john = "João Silva";
            var $jane = "Jane Smith";
            public $robert = "Robert Paulsen";
            public $smith = "Smith";
        }
        $objeto = new objeto();


        //Arrays
        $arrPadrao = ['lucas', 'pedro', 'alex', 'ana', 'brenda', ...$nomes];
        $todosOsNomes = &$arrPadrao;
        var_dump($todosOsNomes, '<br>');
        $arrPadrao[] = 'cleiton';
        unset($arrPadrao[3]);

        $arrComChaves = ['nome' => 'lucas', 'idade' => 17, 'sexo' => 'male'];
        $arrComChaves['saldo'] = 124.50;
        
        var_dump($arrPadrao, '<br>', $arrComChaves, '<br>');
        print "O estudante $arrPadrao[0] tem {$arrComChaves['idade']} anos" . "<br>";
        
        [$lucas, $pedro, $alex] = $arrPadrao;
        print "$lucas $pedro $alex" . "<br>"; 

        $a = 1;
        $b = 2;
        [$b, $a] = [$a, $b];
        echo $a;    // imprime 2
        echo $b;    // imprime 1

        // for ($i = 0; $i < $count; $i++) {
        //     echo "\nVerificando $i: \n";
        //     echo "Ruim: " . $array['$i'] . "\n";
        //     echo "Bom: " . $array[$i] . "\n";
        //     echo "Ruim: {$array['$i']}\n";
        //     echo "Bom: {$array[$i]}\n";
        // }


        //interpolação simples
        print "Uso de strings com variaveis $str" . PHP_EOL . '<br>';
        print 'string simples';


        // tipos de string e interpolação "avançada"
echo <<<END
    $str | representação simples de variavel <br>
    ${str}s | uso de chaves para delimitar o nome de uma variável <br>
    sumonando itens de listas  com sintaxe complexa | {$objeto->jane} ou {$objeto->{$nomes[0]}} 
END;
    var_dump("2E1" == "020"); // "2E1" é 2 * (10 ^ 1), ou 20    


    ?>
</body>
</html>