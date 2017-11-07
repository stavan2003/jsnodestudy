<?php

class Address {

    const ADDRESS_TYPE_RESIDENCE = 1;
    const ADDRESS_TYPE_BUSINESS = 2;
    const ADDRESS_TYPE_PARK = 3;

    static public $address_types = [
        Address::ADDRESS_TYPE_RESIDENCE => 'Residence',
        Address::ADDRESS_TYPE_BUSINESS => 'Business',
        Address::ADDRESS_TYPE_PARK => 'Park'
    ];

    static public function isValidAddressType($id) {
        return array_key_exists($id, Address::$address_types);
    }

    public $street_address_1;
    public $street_address_2;
    public $city_name;
    public $subdivision_name;
    protected $postal_code;
    public $country_name;
    protected $address_type_id;
    protected $_address_id;
    protected $_time_created;
    protected $_time_updated;

    function __construct($data = array()) {
        $this->_time_created = time();
        if (!is_array($data)) {

        }
    }

    function __toString() {
        return $this->display();
    }

    function __get($name) {
        if (!isset($this->postal_code)) {
            $this->postal_code = $this->_guess_postal_code();
        }
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        trigger_error('Undefined property via get:' . $name);
        return NULL;
    }

    function __set($name, $value) {
        echo " <br>>>>>>>    __set invoked for : $name with value $value\n";
        if ($name == 'address_type_id') {
            $this->_setAddressTypeId($value);
            return;
        }
        if ($name == 'postal_code') {
            $this->$name = $value;
            return;
        }
        trigger_error('Undefined property via set:' . $name);
    }

    function __unset($name) {
        echo "<br>  ####### Unset called\n";
        if ($name == 'postal_code') {
            unset($this->$name);
            return;
        }
    }

    protected function _guess_postal_code() {
        $db = Database::getInstance();
        /* @var $mysqli mysqli */
        $mysqli = $db->getConnection();
        $city_name = $mysqli->real_escape_string($this->city_name);
        $subdivision_name = $mysqli->real_escape_string($this->subdivision_name);
        $sql_query = 'Select postal_code from location where city_name = "' . $city_name . '" AND subdivision_name = "' . $subdivision_name . '"';
        /* @var $result mysqli_result */
        $result = $mysqli->query($sql_query);
        if (!$result) {
            throw new Exception("Database Error [{$mysqli->errno}] {$mysqli->error}");
        }
        if ($row = $result->fetch_assoc()) {
            echo json_encode($row);
            return $row['postal_code'];
        }
        //return 'LOOKUP';
    }

    function display() {
        $output = '';
        $output .= $this->street_address_1;
        if ($this->street_address_2) {
            $output .= '<br/>' . $this->street_address_2;
        }
        $output .= '<br/>' . $this->subdivision_name;
        $output .= '<br/>' . $this->city_name . ' ' . $this->postal_code;
        $output .= '<br/>' . $this->country_name;

        return $output;
    }

    /*
     * Use $this to refer to the current object.
     * Use self to refer to the current class. In other words,
     * use  $this->member for non-static members, use self::$member for static members.
     */

    protected function _setAddressTypeId($id) {
        if (self::isValidAddressType($id)) {
            $this->address_type_id = $id;
        }
    }

}
