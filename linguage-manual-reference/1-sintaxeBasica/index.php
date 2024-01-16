<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    $logging = true;
    echo "Hello, word!";
?>  
<?php if ($logging == true): ?>
    <h1>Hello user</h1>
<?php else: ?>
    <h1>Logging error</h1>
<?php endif; ?>

</body>
</html>

