<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<h1>exceptions</h1>
<?php 
    class MyException extends Exception {
        public function __construct($message, $number, $dev_creator) {
            $message = $message . ' created by ' . $dev_creator;
            
            parent::__construct($message, $number);
        }
    }

    $test = 3;

    try {
        switch ($test) {
            case 1:
                echo 'good';
                break;
            case 2:
                throw new MyException('[ERROR] not exist', 2, 'lucas');
                break;
            case 3:
                throw new Exception('[ERROR] not working', 333);

        };

    } catch (MyException $e) {
        echo 'not can be maked ', get_class($e), $e->getMessage();

    } catch (Exception $e) {
        echo 'not can be maked ', get_class($e), $e->getMessage();
        
    } finally {
        echo '<br />' . 'good day';
    }
?>
</body>
</html>