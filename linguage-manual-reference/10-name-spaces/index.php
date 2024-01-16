<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include 'restaurant-info/restaurant.php';
    include 'foods-info/foods.php';
    use const restaurant\PIZZA as order;

    
    echo foods\PIZZA, ' pizzas of the foods <br />';
    echo order, ' pizzas of the restaurant';
    // echo store\quantity_books;

?>
</body>
</html>