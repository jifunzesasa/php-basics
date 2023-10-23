<?php

declare(strict_types=1);

require_once 'vendor/autoload.php';


function testFaker(): void
{
    $faker = Faker\Factory::create();

    echo $faker->name() . "\n";
    echo $faker->email() . "\n";
    echo $faker->text() . "\n";
}



function loadEnvFromFile($file)
{
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            putenv("$key=$value");
        }
    }
}

// Load environment variables from the .env file
loadEnvFromFile('.env');

// Database connection configuration
$host = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');

// Function to establish a database connection
function createDatabaseConnection()
{
    global $host, $username, $password, $database;

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


// Function to insert records into the subscribers table
function insertSubscribers($numRecords)
{
    $conn = createDatabaseConnection();
    $faker = Faker\Factory::create();

    $stmt = $conn->prepare("INSERT INTO subscribers (subscriber_id, first_name, last_name, email, subscription_date) VALUES (?, ?, ?, ?, ?)");

    for ($i = 0; $i < $numRecords; $i++) {
        $subscriber_id = $i + 1; // Incrementing subscriber_id
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        $email = $faker->email;
        $subscription_date = $faker->date;

        $stmt->bind_param("issss", $subscriber_id, $first_name, $last_name, $email, $subscription_date);

        if ($stmt->execute()) {
            echo "Record $subscriber_id inserted successfully." . PHP_EOL;
        } else {
            echo "Error inserting record $subscriber_id: " . $stmt->error . PHP_EOL;
        }
    }

    $stmt->close();
    $conn->close();
}


function createSubscribersTable()
{
    $conn = createDatabaseConnection();


    // create if doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS subscribers (
        subscriber_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(30) NOT NULL,
        last_name VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        subscription_date DATE
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Table subscribers created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }

    $conn->close();
}

echo "Loading environment variables from .env file..." . PHP_EOL;
loadEnvFromFile('.env');

echo "Creating subscribers table..." . PHP_EOL;
createSubscribersTable();

echo "Inserting 10 records into subscribers table..." . PHP_EOL;
insertSubscribers(10);
