<?php

/**
 * Class HashMap
 */
class HashMap
{
    /**
     * An array to hold the key-value pairs.
     * 
     * @var array<mixed, mixed>
     */
    private $hashMap;

    /**
     * HashMap constructor.
     */
    public function __construct()
    {
        $this->hashMap = array();
    }

    /**
     * Adds a key-value pair to the hash map.
     * 
     * @param $key
     * @param $value
     */
    public function put($key, $value)
    {
        $this->hashMap[$key] = $value;
    }

    /**
     * Returns the value associated with the given key.
     * 
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        return $this->hashMap[$key] ?? null;
    }

    /**
     * Checks if the given key exists in the hash map.
     * 
     * @param $key
     * @return bool
     */
    public function containsKey($key)
    {
        return isset($this->hashMap[$key]);
    }

    /**
     * Removes the given key and its associated value from the hash map.
     * 
     * @param $key
     * @return void
     */
    public function remove($key)
    {
        unset($this->hashMap[$key]);
    }

    /**
     * Iterates over the hash map.
     */
    public function iterate()
    {
        foreach ($this->hashMap as $key => $value) {
            echo "Key: " . $key . ", Value: " . $value . "<br>";
        }
    }
}

// Usage example:
$hashMap = new HashMap();

// Adding elements to the hash map
$hashMap->put("key1", "value1");
$hashMap->put("key2", "value2");
$hashMap->put("key3", "value3");

// Accessing elements in the hash map
echo $hashMap->get("key1"); // Output: value1
echo $hashMap->get("key2"); // Output: value2

// Modifying elements in the hash map
$hashMap->put("key2", "new value");
echo $hashMap->get("key2"); // Output: new value

// Checking if a key exists in the hash map
if ($hashMap->containsKey("key3")) {
    echo "Key 'key3' exists in the hash map.";
} else {
    echo "Key 'key3' does not exist in the hash map.";
}

// Removing an element from the hash map
$hashMap->remove("key1");
echo $hashMap->get("key1"); // Output: Notice: Undefined index: key1

// Iterating over the hash map
$hashMap->iterate();
