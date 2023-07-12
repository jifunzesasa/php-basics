<?php


// Creating a hash map
$hashMap = array();

// Adding elements to the hash map
$hashMap["key1"] = "value1";
$hashMap["key2"] = "value2";
$hashMap["key3"] = "value3";

// Accessing elements in the hash map
echo $hashMap["key1"]; // Output: value1
echo $hashMap["key2"]; // Output: value2

// Modifying elements in the hash map
$hashMap["key2"] = "new value";
echo $hashMap["key2"]; // Output: new value

// Checking if a key exists in the hash map
if (isset($hashMap["key3"])) {
    echo "Key 'key3' exists in the hash map.";
} else {
    echo "Key 'key3' does not exist in the hash map.";
}

// Removing an element from the hash map
unset($hashMap["key1"]);
echo $hashMap["key1"]; // Output: Notice: Undefined index: key1

// Iterating over the hash map
foreach ($hashMap as $key => $value) {
    echo "Key: " . $key . ", Value: " . $value . "<br>";
}
