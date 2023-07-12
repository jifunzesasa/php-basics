<?php

class MyCounter implements Countable {
    private $count = 0;

    public function __construct($count = 0) {
        $this->count = $count;
    }

    public function __toString():string {
        return (string)$this->count;
    }

    public function __invoke():int {
        return ++$this->count;
    }

    public function count():int {
        return ++$this->count;
    }
}

$counter = new MyCounter;

for($i=0; $i<10; ++$i) {
    echo "I have been count()ed " . count($counter) . " times\n";
}
