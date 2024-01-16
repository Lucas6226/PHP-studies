<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    $count = 0;
    echo $count, '<br/>';
    $count++;
    echo $count,  '<br/>';
    $count+=3;
    echo $count,  '<br/>';
    echo ($count > 1) ? 'maior' :'menor';
?>
</body>
</html>