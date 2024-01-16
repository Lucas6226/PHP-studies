<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    function numbers() {
        for ($i = 0; $i < 10; $i++) {
            yield $i;
        }
        yield 33;
    }

    foreach (numbers() as $n) {
        echo $n, '<br />';
    }
?>
<?php 
    function myArray($inf, $keys) {
        $count = 0;
        for($c = 0; $c < count($inf); $c+=2) {
            yield $keys[$count] => [$inf[$c], $inf[$c+1]];
            $count += 1; 
        }
    }

    $datas = ['lucas', 34, 'pedro', 45, 'joao', 42, 'cleiton', 12];
    $id = [21, 22, 23, 24];


    foreach (myArray($datas, $id) as $key => $array) {
        echo "ID account: $key", '<br />';
        echo "name: $array[0]", '<br />';
        echo "age: $array[1]", '<br />';
        echo "<br />";
    }
?>
<?php 
    function x() {
        yield 5;
    }

    function another() {
        yield 3;
        yield 4;
        yield from x();
    }

    function update() {
        yield 0;
        yield 1;
        yield 2;
        yield from another();
        yield from [6, 7];
        yield 8;
    }

    foreach(update() as $msg) {
        echo $msg, "\n";
    }
?>
</body>
</html>