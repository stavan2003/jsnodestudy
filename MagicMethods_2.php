<?php

/*
 * http://culttt.com/2014/04/16/php-magic-methods/
 * 
 */

/*
 * The __construct() method is automatically called when the object is first created. 
 * This means you can inject parameters and dependancies to set up the object.
 */

class Entity {

    protected $meta;

    public function __construct(array $meta) {
        $this->meta = $meta;
    }

}

/*
 * When you extend an object, the parent object will sometimes also have a __construct() method 
 * that is expecting something to be injected into the object. 
 * You satisfy this requirement by calling the parent’s __construct() method:
 */

class Tweet extends Entity {

    protected $id;
    protected $text;

    public function __construct($id, $text, array $meta) {
        $this->id = $id;
        $this->text = $text;
        parent::__construct($meta);
    }

    protected function retweet() {
        $this->meta['retweets'] ++;
    }

    protected function favourite() {
        $this->meta['favourites'] ++;
    }

    /* The __get() method will listen for requests for properties that are not public properties.
     * PHP will automatically call it for you when you try to access a property that is not one of the object’s public properties.
     * E.g. $tweet->text is invalid call as $text is not public property
     */

    public function __get($property) {
        echo "Get called for $property\n";
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    /*
     * If you try to set a property that is not accessible, the __set() magic method will be triggered. 
     * This method takes the property you were attempting to access and the value you were trying to set as two arguments.
     */

    public function __set($property, $value) {
        echo "Set called for $property\n";
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    /*
     * If you attempt to use this function to check the presence of a property that isn’t publicly accessible, 
     * you can use the __isset() magic method to respond:
     */

    public function __isset($property) {
        return isset($this->$property);
    }

    /*
     * If the property you are trying to unset is not public, 
     * the __unset() method will catch the request and allow you to implement it from within the class:
     */

    public function __unset($property) {
        unset($this->$property);
    }

    /*
     * The __toString() method allows you to return the object as a string representation.
     */

    public function __toString() {
        return $this->text;
    }

    /*
     * The __call() method will pick up when you try to call a method that is not publicly accessible on the object. 
     * For example you might have an array of data on the object that you want to mutate before returning:
     */

    public function __call($method, $parameters) {
        echo "\n __call invoked \n";
        if (in_array($method, array('retweet', 'favourite'))) {
            return call_user_func_array(array($this, $method), $parameters);
        }
    }

}

header("Content-Type: text/plain");
$tweet = new Tweet(123, 'Hello world', array('retweets' => 23, 'favourites' => 17));
//echo var_dump($tweet);


/*
 * generally speaking, the properties on an object will be set to protected and so attempting to access a property in this way 
 * will cause an error. The __get() method will listen for requests for properties that are not public properties:
 */
// echo $tweet->text; // This will give error -  Fatal error: Cannot access protected property Tweet::$text without the __get method

$tweet->text = 'Setting up my twttr\n';
echo $tweet->text; // 'Setting up my twttr'

isset($tweet->text); // true

echo $tweet; // 'hello world'

$tweet->retweet(); //__call is invoked
echo print_r($tweet->meta,true); // array(2) { ["retweets"]=> int(24) ["favourites"]=> int(17) }
