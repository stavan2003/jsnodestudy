<?php

class Database {

    private $_connection;
    private static $_instance;

    public static function getInstance() {
        if (!self::$_instance) {
            /*
             * self points to the class in which it is written.
             * So, if your getInstance method is in a class name MyClass, the following line :
             *      self::$_instance = new self();
             * Will do the same as :
             *      self::$_instance = new MyClass();
             */

            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->_connection = new mysqli('localhost', 'root', 'root', 'ciappdb', 3306);
        if (mysqli_connect_error()) {
            trigger_error('Not able to connected to mysqli' . mysqli_connect_errno(), E_USER_ERROR);
        }
    }

    /*
     * Once the cloning is complete, if a __clone() method is defined, then the newly created object's  __clone() method will be called,
     * to allow any necessary properties that need to be changed.
     * http://php.net/manual/en/language.oop5.cloning.php#object.clone
     * So yes, it's a callback after the clone operation has finished. Nothing more, nothing less.
     *
     */

    private function __clone() {

    }

    public function getConnection() {
        return $this->_connection;
    }

}
