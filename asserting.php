<?php


class Person
{
    protected string $name;
    public function __construct(string $name)
    {
        assert(!empty($name), new InvalidArgumentException('Name can not be empty.'));
        $this->name = $name;
    }
}

$person = new Person('A');