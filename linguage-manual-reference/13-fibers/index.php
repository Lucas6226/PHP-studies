<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Fibers</h1>
<?php 
    function Loop(): void { 
        for ($i = 0; $i < 10; $i++) {
            Fiber::suspend($i); 
        }
    };

    $one = new Fiber(Loop(...));
    $one->start();
    
    
    $two = new Fiber(Loop(...));
    $two->start();

    for ($c = 0; $c < 10; $c++) {
        echo $one->resume(), '<br />';
        echo $two->resume(), '<br />';
    }
?>
<?php 
    function myLoop(): void {  // fiber function 
        $v = Fiber::suspend('iniciou <br>'); // is used as a paramether, declared at first resume
        for ($i = 0; $i < $v+1; $i++) {
            Fiber::suspend($i);  // return $i value for a respect resume
        }
        Fiber::suspend('final'); 
    };


    
    $myFiber = new Fiber(myLoop(...));
    $myOther = new Fiber(myLoop(...));
    
    $count = 0;
    while ($count != 3) {
        if ($count == 0) {
            echo $myFiber->start();
            $fib = $myFiber->resume(20); // first resume for declare a patameter

            echo $myOther->start();
            $oth = $myOther->resume(10);
            
            $count++;
        } else {
            if ($fib != 'final' && $fib != 'x') {
                echo $fib, '<br />';
                $fib = $myFiber->resume();
            } elseif ($fib == 'final') {
                $fib = 'x';
                $count++;
            } 
            
            if ($oth != 'final' && $oth != 'x') {
                echo $oth , '<br />';
                $oth = $myOther->resume();
            } elseif ($oth == 'final') {
                $oth = 'x';
                $count++;
            }
        }
    }
?>
</body>
</html>