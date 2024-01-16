<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
    // see reflection an another/reflection before se this

    #[Attribute]
    class MyAttributeForProperty {
        public function __construct(
            public string $className,
            public string $propertyName,

        ) {
            echo 'class '. $className;
            echo 'function '. $propertyName;
        }
    }

    #[Attribute]
    class MyAttributeForMethods {
        public function __construct(
            public string $className,
            public string $functionName,
            public array $paramethers

        ) {
            echo 'class '. $className;
            echo 'function '. $functionName;
            foreach ($paramethers as $paramether) {
                echo $paramether;
            }
        }
    }


    class CreateUser {
        #[MyAttributeForProperty('CreateUser', 'local')]
        #[MyAttributeForProperty('CreateUser', 'xxx')]
        public string $local = 'my house';

        #[MyAttributeForMethods('createUser', 'create', ['name', 'password'])]
        function create(string $name, int $password) {
            echo 'created:'. '<br>'. 
            '  user: '. $name . '<br>'. 
            ' password:' . $password;
        }
    }

    $property = new \ReflectionProperty(CreateUser::class, 'local');
    echo '<pre>', var_dump($property->getAttributes()[0]->newInstance()), '</pre>';


    $method = new \ReflectionMethod(CreateUser::class, 'create');
    // $method->invokeArgs(new CreateUser(), ['lucas', 3223]);
    echo '<pre>', var_dump($method->getAttributes()[0]->newInstance()), '</pre>';
?>
</body>
</html>