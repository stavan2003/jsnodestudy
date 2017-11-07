<?php

/*
 *  To achieve
 *  string('Alex', function($name){
  echo $name['upper'];
  });
 */

function name($string) {
    $results = [
        'upper' => strtoupper($string),
        'lower' => strtolower($string)
    ];
    return $results;
}

$name = name('Stavan');
echo $name['upper'];    // STAVAN
// Re-writing the above in more easy and readable format

function string($string, $callback) {
    $results = [
        'upper' => strtoupper($string),
        'lower' => strtolower($string)
    ];
    if (is_callable($callback)) {
        call_user_func($callback, $results);
    }
}

string('Stavan', function($name) {
    echo "\n" . $name['upper']; //STAVAN
});



/*
 * If you don't know beforehand how many arguments you're going to pass to your function,
 * it would be advisable to use call_user_func_array();
 * the only alternative is a switch statement or a bunch of conditions to accomplish a predefined subset of possibilities.
 */

$params = [1, 2, 3, 4, 5];

function test_function() {
    echo implode('+', func_get_args()) . '=' . array_sum(func_get_args()) . "\r\n";
}

// Normal function as callback
$callback_function = 'test_function';
call_user_func_array($callback_function, $params); // 1+2+3+4+5=15
$callback_function(...$params); // 1+2+3+4+5=15


/*
 * The difference between call_user_func_array() and variable functions as of php 5.6 is that variable functions
 * do not allow you to call a static method.
 * Php 7 adds the ability to call static methods via a variable function,
 * so as of php 7 this difference no longer exists.
 * In conclusion, call_user_func_array() gives your code greater compatibility.
 */

class TestClass {

    static function testStaticMethod() {
        echo implode('+', func_get_args()) . '=' . array_sum(func_get_args()) . "\r\n";
    }

    public function testMethod() {
        echo implode('+', func_get_args()) . '=' . array_sum(func_get_args()) . "\r\n";
    }

}

// Class method as callback
$obj = new TestClass;
$callback_function = [$obj, 'testMethod'];
call_user_func_array($callback_function, $params); // 1+2+3+4+5=15
$callback_function(...$params); // 1+2+3+4+5=15
// Static method callback
$callback_function = 'TestClass::testStaticMethod';
call_user_func_array($callback_function, $params); // 1+2+3+4+5=15
$callback_function(...$params); // Fatal error: undefined function



/*
 * func_get_args allows you to do is add a little syntactic sugar.
 *
 */

/*
 * https://stackoverflow.com/questions/151969/when-to-use-self-over-this
 * https://ideone.com/7etRHy
 *
 */


/*
 * self refers to the same class in which the new keyword is actually written.
 * static, in PHP 5.3's late static bindings, refers to whatever class in the hierarchy you called the method on.
 * In the following example, B inherits both methods from A.
 * The self invocation is bound to A because it's defined in A's implementation of the first method, whereas static is bound to the called class
 */

class A {

    public static function get_self() {
        return new self();
    }

    public static function get_static() {
        return new static();
    }

}

class B extends A {

}

echo get_class(B::get_self());  // A
echo get_class(B::get_static()); // B
echo get_class(A::get_self()); // A
echo get_class(A::get_static()); // A