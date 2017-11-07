<?php

// The overloading methods are invoked when interacting with properties or methods 
// that have not been declared or are not visible in the current scope.

class MagicMethods {
    
    function __get($name) {
        echo "An inaccessible call made for not existing variable $name";
    }
    
    function __set($name, $value) {
        echo "An attempt made to set value for not existing variable $name with value $value";
    }
    
    //magic method __call() must have public visibility and cannot be static 
    public function __call($name, $arguments) {
        $a = print_r($arguments, true);
        echo "An attempt made to unidentified method $name with parameters $a";
    }
    
    //magic method __callStatic() must have public visibility and be static
     public static function __callStatic($name, $arguments) {
        $a = print_r($arguments, true);
        echo "An attempt made to unidentified static method $name with parameters $a";
    }
}

$a = new MagicMethods();
echo '<h3>__get called : $a->bbb</h3>';
echo $a->bbb;

echo '<h3>__set called : $a->bbb = 444</h3>';
$a->bbb = 444;

echo '<h3>__call called : $a->unknownMethod(\'123\', \'456\')</h3>';
$a->unknownMethod('123', '456');

echo '<h3>__callStatic called : $a::unknownStaticMethod(\'123\', \'456\')</h3>';
$a::unknownStaticMethod('123', '456');

