<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<h1>pure case</h1>
<?php 
    enum Naipe {
        case copas;
        case ouros;
        case paus;
        case espadas;
    };

    echo Naipe::ouros->name, '<br/>'; 


    $var = Naipe::copas;
    function teste(Naipe $x) {
        echo "true", '<br>';
    }
    teste($var);


    class MyObjectForExemple {
        public const NAME = 'MyObjectForExemple';
        public $naipe;
    };
    $object = new MyObjectForExemple;
    $object->naipe = Naipe::espadas;  

    if ($object->naipe = Naipe::espadas) {
        echo 'espada';
    } else {
        echo 'not are espada';
    }
?>
<h1>backed enums</h1>
<?php 
    enum names: string {
        case lucas = 'A';
        case pedro = 'B';
        case alex = 'C';
        case junior = 'D';
    }
    echo names::from('B')->name, '<br>';


    enum Requests: int {
        case pizza = 0;
        case hamburguer = 1;
        case iceCream = 2;
        case sandwich = 3;
    }


    function search($Enum, $v) {
        $x = $Enum::tryFrom($v);
        if ($x == true) {
            return $x->name;
        } else {
            return "Dont't exist";
        }
    }

    echo search('Requests', 2), '<br>'; // return "iceCream"
    echo search('Requests', 7);         // return "Dont't exist"
?>
<h1>methods and interfaces at enums</h1>
<?php 
    interface colors{
        function color() : string;
    }

    enum cards: string implements colors {
        case copas = 'c';
        case ouros = 'o';
        case paus = 'p';
        case espadas = 'e';

        function color(): string { // from interface
            return match($this) {
                cards::copas, cards::ouros => 'red <br>',
                cards::paus, cards::espadas => 'black <br>',
            };
        }

        function shape() {  // optional
            return 'retangled <br>';
        }
    }

    $var = cards::copas;
    echo $var->color();
    echo $var->shape();

    $varTwo = cards::paus->color();
    echo $varTwo;
?>
<h1>static methods, consts and cases at enums</h1>
<?php 
    enum size {
        case big;
        case medium;
        case small;
        public const another = self::big;

        public static function initialize(float $v): static {
            return match(true) {
                $v < 50 => static::small,
                $v < 100 => static::medium,
                default => static::big,
            };
        }
    }

    echo size::initialize(40)->name, '<br>'; // return small
    echo size::initialize(60)->name, '<br>';  // return medium
    echo size::initialize(190)->name, '<br>';  // return big 

    echo size::another->name, '<br>';

    var_dump(size::cases());
?>
</body>
</html>