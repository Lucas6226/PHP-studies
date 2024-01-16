<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    /** class for register datas of .... */
    class Exemple {
        public string $DevName = 'lucas';
        private string $local;
        
        private function SeeLocalNow($time): string {
            return "$this->local at this $time";
        }

        /** return the local of .... */
        public function SeeLocal(): string {
            return $this->local;
        }
    }

    $reflectionClass = new ReflectionClass(Exemple::class); // reflection class for real Exemple class 
?>
<?php 
    // see informations of exemple
    echo '<pre>', 
        var_dump(
            $reflectionClass->getProperties(), 
            $reflectionClass->getMethods()
        ), 
    '</pre>';
    echo '<br>';

    
    // se datas of 'exemple'
    $name = $reflectionClass->getProperty('DevName');
    // $name = new \ReflectionProperty(Exemple::class, 'DevName');  // more pratical
    
    var_dump($name->getValue(new Exemple));
    echo '<br>';
    var_dump($name->getValue($reflectionClass->newInstanceWithoutConstructor()));     // <-- new instance without 
    echo '<br>';                                                                      //   executing construct method
?>
<?php 
    // manipulations datas of 'exemple'
    $object = $reflectionClass->newInstanceWithoutConstructor(); // create a new instance that can be modified
    
    $name->setValue($object, 'alex');          // turn the name
    var_dump($name->getValue($object));
    echo '<br>';

    // private (is identical) 
    $local = $reflectionClass->getProperty('local');
    
    $local->setValue($object, 'here');
    var_dump($local->getValue($object));
    echo '<br>';
?>
<?php 
    // methods 
    $method = $reflectionClass->getMethod('SeeLocal');
    echo $method->invoke($object);
    echo '<br>';
    
    $method = $reflectionClass->getMethod('SeeLocalNow');
    echo $method->invokeArgs($object, ['now']);
    echo '<br>';
?>
<?php 
    // coments
    echo $reflectionClass->getDocComment(), '<br>';
    echo $reflectionClass->getMethod('SeeLocal')->getDocComment();
?>
</body>
</html>