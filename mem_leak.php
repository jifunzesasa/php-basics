<?php

ini_set('memory_limit', '64M'); // Set memory limit to 64 megabytes

class MemoryEfficientDemo {
    private $data = [];

    public function addData($value) {
        $this->data[] = $value;
    }
}

while (true) {
    $userInput = readline("Enter a value (or 'q' to quit): ");
    if ($userInput === 'q') {
        break;
    }

    $demo = new MemoryEfficientDemo();

    $limit = is_numeric($userInput) ? (int) $userInput : 1000000;
    for ($i = 0; $i < 1000000; $i++) {
        $demo->addData(str_repeat('x', $limit));
    }
}

echo "Exiting the program.\n";
