<?php

$email  = 'alphaolomi@gmail.com';
echo "Email: $email\n";

$domain = strstr($email, '@');
echo "Domain: $domain\n"; // prints @example.com

$user = strstr($email, '@', true);
echo "Name: $user\n"; // prints name


class Name {
    public $first;
    public $last;

    public function __construct($first, $last) {
        $this->first = $first;
        $this->last  = $last;
    }

    

    public static function make($data) {
        return new static($data['first'], $data['last']);
    }

    public function __toString() {
        return "$this->first $this->last";
    }
}


function getNameFromEmail(string $email) {
    // $domain = strstr($email, '@');
    $user = strstr($email, '@', true);
    return $user;
}

// 
// $name = new Name('John', 'Doe');
// echo $name; // prints John Doe