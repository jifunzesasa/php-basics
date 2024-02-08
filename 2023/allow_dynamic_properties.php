<?php


function logError($error)
{
    echo "Error: " . $error;
    echo "\n";
}

class MyUser
{
    public string $name;
    public int $age;

    // public function __set(string $name, mixed $value): void {
    //     trigger_error('Undefined property: ' . static::class . '::$' . $name, E_USER_DEPRECATED);
    // }
}

try {
    $user = new MyUser();
    $user->name = 'John Doe';
    $user->age = 30;
    // Attempting the following line will raise a deprecation notice in PHP 8.2+
    $user->email = 'john.doe@example.com'; // This line will cause an issue if #[AllowDynamicProperties] is not used.
    var_dump($user);
} catch (\Throwable $th) {
    logError($th->getMessage());
}



// ==================================================

#[AllowDynamicProperties]
class DynamicUser
{
    public string $name;
    public int $age;
}

try {
    $user = new DynamicUser();
    $user->name = 'John Doe';
    $user->age = 30;
    $user->email = 'john.doe@example.com'; // This is now allowed.

    var_dump($user);
} catch (\Throwable $th) {
    logError($th->getMessage());
}

// ==================================================