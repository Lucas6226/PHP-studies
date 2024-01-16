<?php 
    function H2(string $str = 'divider') {echo '<h2 style="color: gray;">'. $str .'</h2>';}

    const BR = '<br/>';  // BR
    function BR() {echo '<br/>';} 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<h1>basic class</h1>
<?php 
    class genericClass {
        public $var = 'string';
        public $name = 'name of user';          // <-- for extends examples (line 50)
        
        public function baseFunction() {
            echo $this->var;
        }

        public function otherFunction() {
            echo '<br/>';
            $this->baseFunction();
        }
    }

    $myVar = new genericClass();
    $myVar->baseFunction();
    $myVar->otherFunction();
?>
<h1>single instances</h1>
<?php 
    class basic {
        public $name = 'my name';
        public function baseFunction() {
            echo 'called';
        }
    }

    $var_1 = new basic();

    $var_2 = $var_1;
    $var_3 =& $var_1;

    // $var_2 = null;
    $var_2->name = 'another name';

    echo $var_1->name, '<br/>', 
         $var_2->name, '<br/>',  
         $var_3->name, '<br/>';
?>
<h1>extends</h1>
<?php 
    class ChildClass extends genericClass {
        public $name = 'acount name';
        public function otherFunction($selector = false) {
            if ($selector) {
                parent::otherFunction();
            }
            echo '<br/> another string';
        }
    }
    $my_class = new ChildClass;

        
    // echo $parrent::my_class->name, '<br/>';    [ERROR]
    // echo $my_class->parrent::name, '<br/>';    [ERROR]
    $my_class->baseFunction();
    1 ? 
        $my_class->otherFunction(true) : 
        $my_class->otherFunction(false);
?>
<h1>Visibilitys and static</h1>
<?php 
    class firstClass {
        public static $sex = 'M';
        public static function double($n1) {return $n1*2;}

        public $name = 'lucas';
        protected $address = '224 IabaBabaDu Street';
        private $cardBalance = 0.02; 

        public function seeInfo() {
            echo $this->name, '<br/>', // always available
                 $this->address, '<br/>', // only here and ata a children 
                 $this->cardBalance, '<br/>'; // only here 
        }
    }
    class newClass extends firstClass {
        public function seeNewInfo() {
            echo $this->name, '<br/>', 
                 $this->address, '<br/>';
                //  $this->cardBalance, '<br/>';    //<--- [ERROR] unavailable 
        }
    }

    // public 
    $firstObject = new firstClass; 
    $firstObject->seeInfo();
    echo '<br/>';
    
    // pretected
    $newObject = new newClass;
    $newObject->seeNewInfo();
    echo '<br/>';

    //private 
    echo $firstObject->name;//       <-- can be used
    // echo $firstObject->address;      <-- can be used only at classes 
    // echo $firstObject->cardBalance;          <--can't be used
    echo '<br/>';

    // static 
    echo firstClass::$sex;
    echo firstClass::double(2);
    // echo $firstObject->sex;    <-- [ERROR]
?>
<h1>construct (more const)</h1>
<?php 
    class generateUser {
        public const STORE = 'nike';

        public function __construct(
            public string $name,
            public string $email

        ) {
            echo 'generate user ' . $name . ' ' . $email, '<br/>';
        }
    }

    class userFeature extends generateUser {
        public int $old;
        
        function __construct($name, $email, $old) {
            $this->old = $old;

            echo 'user feature ' . $old, '<br/>';
            parent::__construct($name, $email);
        }

        function __destruct() {
            echo 'deleted', '<br/>';
        }
    }


    $account = new generateUser('lucas', 'sla@gmail.com');
    echo '<br/>';
    $feature = new userFeature('pedro', 'tutu@gmail.com', 17);    
    $feature = null;
?>
<h1>Multiple __constructs and redonly</h1>
<?php 
    class generateAccount {
        function __construct(
            private ?string $user = null,

            readonly ?string $password = null, // for admins
            readonly ?string $email = null // for users
        ) {}

        public static function Admin(string $user, string $password) { 
            echo 'Admin registered: ' . $user . ' | ' . $password, '<br/>';
            return new static(user: $user, password: $password);
        }

        public static function User(string $user, string $email) {
            echo 'User registered: ' . $user . ' | ' . $email, '<br/>';
            return new static(user: $user, email: $email);
        }

        public function seeInfo() {
            echo $this->user, '<br/>',
                 $this->password, '<br/>',
                 $this->email, '<br/>';
        } 
    }

    // $user = new generateAccount();   <-- don't work 

    
    $admin = generateAccount::Admin('lucas', 'bubu'); 
    // $admin->password = 'ee';     [ERROR] for redonly
    echo $admin->password, '<br/>';   

    $user = generateAccount::User('pedro', 'dodo@gmail.develop');
    // $user->email = 'non.gmail.com';        [ERROR] for redonly
    echo $user->email, '<br/>';
?>
<h1>abstract class and interfaces</h1>
<?php 
    H2('Abstract class');
    abstract class exempleAbs{
        protected const VALUE = 3;
        static function seeData() {return 'name of user';}

        abstract static function multiply(int $n1); // definition of mandatory method
    }
    class extension extends exempleAbs {
        static function multiply(int $n1) { // mandatory method and parameter
            $result = $n1* self::VALUE;
            return $result;
        }    
    }

    echo extension::multiply(2), '<br />';
    echo extension::seeData(), '<br />';
    
    
    H2('interfaces');
    interface calcTamplate {
        public function add($n1, $n2);
        public function sub($n1, $n2);
    }
    interface strTamplate {
        public const STR = 'STR: ';
        public function concatenate($str1, $str2);
        public function upper($str);
    }
    interface ultra extends strTamplate, calcTamplate {}

    class calc implements calcTamplate{ // mandatory methods of calcTamplate
        public function add($n1, $n2) { return $n1 + $n2; }
        public function sub($n1, $n2) { return $n1 - $n2; }
    }
    class multiplyUse implements ultra { // mandatory methods of calcTamplate and strTamplate
        public function add($n1, $n2) { return $n1 + $n2; }
        public function sub($n1, $n2) { return $n1 - $n2; }

        public function concatenate($str1, $str2) {return self::STR . $str1 . $str2;}
        public function upper($str) {return strtoupper($str);}
    }

    $utility = new multiplyUse;
    echo $utility->concatenate('one', ' two'), '<br />';


    H2('abstract class with interfaces');
    interface strPrint {public function see($str);}

    abstract class anything implements ultra {
        public function add($n1, $n2) { return $n1 + $n2; }

        public function upper($str) {return strtoupper($str);}
    }

    class moreAnything extends anything implements strPrint { // because hava a methods at class anything
        public function sub($n1, $n2) { return $n1 - $n2; }
        public function concatenate($str1, $str2) {return self::STR . $str1 . $str2;}

        public function see($str) {echo $str;}
    }
?>
<h1>Traits</h1>
<?php 
    trait firstTrait { // [precedence 1]
        public function add($n1, $n2) { return $n1 + $n2; }
        public function equal() {return true;} //  first declaration at a trait
    }
    trait secondTrait {
        public function sub($n1, $n2) { return $n1 - $n2; }
        public function equal() {return false;} //  repeated declaration
    }
    trait thirdTrait {
        public const ADDRESS = 'dudu';
        public function upper($str) {return strtoupper($str);}
    }
    trait masterTrait {
        use firstTrait, secondTrait, thirdTrait {
            firstTrait::equal insteadof secondTrait;
            secondTrait::equal as falseEqual;
            add as private; 
        }
        abstract public function namer();

        static public function create() {return 'new';}
    }


    class motherClass { // [predence 2]
        public function upper($str) {return 'VALUE' . $str;}
    }
    class childrenClass extends motherClass {  // [precende: 0]
        use masterTrait;

        public function namer() {return 'name';}  // mandatory for masterTrait
        public function concatenate($str1, $str2) {return $str1 . $str2;}
        public function seeAddress() {return self::ADDRESS;}
    }

    $x = new childrenClass;
    echo $x->upper('name'), '<br/>';
    echo $x->equal() ? 'yes': 'no', '<br/>';
    // echo $x->add(2, 2);                <-- dont exist anymore
    echo childrenClass::create(), '<br/>';
    echo $x->seeAddress();
?>
<h1>Anonymous classes</h1>
<?php 
    abstract class someClass {abstract public function property();}
    interface someInterface {}
    trait someTrait {}

    function useCLassMethod($x) {
        $result = $x->property();
        return $result;
    }
    $MyValue = useCLassMethod(new class extends someClass implements someInterface {
        use someTrait;
        public function property() {return 'any value';}
    });

    echo $MyValue;
?>
<h1>magic mathods (more overloading, clone and construct/destruct)</h1>
<?php 
    class overloadingMethods {
        // for all
        private $private_var = 1;
        public $public_var = 0;
        //only for clone
        public $name = 'alex';
        public $age = 17;


        private static function staticAlarm() {
            echo 'static alarm', BR;
        } 
        private function alarm() {
            echo 'static alarm', BR;
        } 

        // to properties
        public function __set(string $name, mixed $value) {
            echo "var: $name cannot be declarete in this scope, value: $value was ignored", '<br/>'; 
        }        
        public function __get($name) {
            echo "var: $name cannot be looked in this scope", '<br/>';
        }
        public function __isset($name) {
            echo "var: $name are private", '<br/>';
        }
        public function __unset($name) {
            echo "var: $name are private", '<br/>';
        }

        // to methods
        public static function __callStatic($name, $arguments) {
            echo "static method $name are private or not exist", '<br/>';
        }
        public function __call($name, $arguments) {
            echo "method $name are private or not exist", '<br/>';
        }

        // to clone
        function __clone() {
            return $this;
        }
    }
    $y = new overloadingMethods;

    // testing a propertis
    H2('__set');
    $y->private_var = 2; //     call  __set
    $y->public_var = 2; //       can maked

    H2('__get');
    echo $y->private_var; //           call  __get
    echo $y->public_var; //           can maked
    BR();

    H2('__isset');
    isset($y->private_var); //           call  __isset
    isset($y->public_var); //           can maked

    H2('__unset');
    isset($y->private_var); //           call  __unset
    isset($y->public_var); //           can maked

    // testing a methods 
    H2('__callStatic');
    $y::staticAlarm();       //call __callStatic

    H2('__call');
    $y->alarm();       //call __callStatic


    // clone
    H2('__clone');
    // two keys for one instance 
    $person_one = new overloadingMethods;
    $clone_one = $person_one;

    // new kay and new identical instance 
    $person_two = clone $person_one;

    echo $person_one->name, BR;
    $clone_one->name = 'lucas';
    
    echo $clone_one->name ,BR,
    $person_one->name, BR;
    BR();
        
    echo $person_two->name, BR; 

?>
<h1>Methods return types</h1>
<?php 
    class ReturnTypes {
        // function number(float $age) {      // exactli float return
        function number(float $age): int {   //  convert to int if possible or return a error 
            return $age;
        }
    }

    $MyNewObject = new ReturnTypes;
    echo $MyNewObject->number(1.3);
?>
</body>
</html>