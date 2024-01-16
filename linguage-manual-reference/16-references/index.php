<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    $name = 'lucas';
    $x = '';
    $x =& $name;
    // $x = 'alex';        <-- turn two vars to "alex"
    
    echo $name, '<br>',$x, '</br>';

    unset($x);
    // echo $name, '<br>',$x, '</br>';     // error, x does not exist


    function add(&$v) {
        $v++;
    };

    $number = 2;
    echo $number, '<br>'; // 2
    add($number);
    echo $number, '<br>'; // 3
?>
</body>
</html>