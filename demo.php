<?php

//require './Address.php';
//require './class.Database.inc';


/*
 * __autoload is generally considered obsolete. It only allows for a single autoloader.
 * __autoload is now officially deprecated as of PHP 7.2.0
 * Generally you should only use __autoload if you're using a version of PHP without support for spl_autload_register.
 * spl_autoload_register allows several autoloaders to be registered which will be run through in turn
 * until a matching class/interface/trait is found and loaded, or until all autoloading options have been exhausted.
 * This means that if you're using framework code or other third party libraries that implement their own autoloaders you don't
 * have to worry about yours causing conflicts.
 */
function my_autoloader($class) {
    include 'class.' . $class . '.inc.php';
}

spl_autoload_register('my_autoloader');


$address = new Address();
echo '<h2>Empty Address</h2>';
echo '<tt><pre>' . var_export($address, TRUE) . '</pre></tt>';

echo '<h2>Setting Address</h2>';
$address->street_address_1 = '840, Queens Plate Drive';
$address->street_address_2 = 'Opposite Woodbine Mall';
$address->subdivision_name = 'Etobicoke';
$address->city_name = 'Toronto';
$address->country_name = 'Ontario';
$address->address_type_id = 1;
$address->postal_code = 'M9W0E7'; // invokes __set
echo '<tt><pre>' . var_export($address, TRUE) . '</pre></tt>';

echo '<h2>Displaying Address</h2>';
echo $address->display();

echo '<h2>Unsetting protected member Postal Code Address</h2>';
unset($address->postal_code);
echo '<h3>Displaying Address</h3    >';
echo $address->display();

echo '<h3>Displaying Address using _toString</h3    >';
echo $address;

echo '<h3> Display Static variables </h3>';
echo '<pre>' . var_export(Address::$address_types, TRUE) . '</pre>';

echo '<h3> Testing address type ID</h3>';
for ($index = 0; $index <= 4; $index++) {
    echo "<div> id : $index : ";
    echo Address::isValidAddressType($index) ? 'valid' : 'invalid';
    echo '</div>';
}


$address_residence = new AddressResidence();
echo '<h2>Setting AddressResidence</h2>';
$address_residence->street_address_1 = '840, Queens Plate Drive';
$address_residence->street_address_2 = 'Opposite Woodbine Mall';
$address_residence->subdivision_name = 'Etobicoke';
$address_residence->city_name = 'Toronto';
$address_residence->country_name = 'Ontario';
$address_residence->address_type_id = 1;
$address_residence->postal_code = 'M9W0E7'; // invokes __set
echo '<tt><pre>' . var_export($address_residence, TRUE) . '</pre></tt>';
