<?php

namespace DataStructure;

/**
 * Class Stack
 * 
 * @package DataStructure
 */
class Stack {
    /**
     * @var array
     */
    private $stack;
    
    /**
     * Stack constructor.
     */
    public function __construct() {
        $this->stack = array();
    }
    
    /**
     * Check if stack is empty.
     * 
     * @return bool
     */
    public function isEmpty() {
        return empty($this->stack);
    }
    
    /**
     * Push item to stack.
     * 
     * @param $item
     */
    public function push($item) {
        array_push($this->stack, $item);
    }
    
    /**
     * Pop item from stack.
     * 
     * @return mixed
     */
    public function pop() {
        if ($this->isEmpty()) {
            echo "Stack is empty.";
        } else {
            return array_pop($this->stack);
        }
    }
    
    /**
     * Peek item from stack.
     * 
     * @return mixed
     */
    public function peek() {
        if ($this->isEmpty()) {
            echo "Stack is empty.";
        } else {
            return end($this->stack);
        }
    }
    
    /**
     * Display stack.
     */
    public function display() {
        if ($this->isEmpty()) {
            echo "Stack is empty.";
        } else {
            echo implode(", ", $this->stack);
        }
    }
}

// Example usage
$stack = new Stack();
$stack->push(5);
$stack->push(10);
$stack->push(15);
$stack->display(); // Output: 5, 10, 15
$stack->pop();
$stack->display(); // Output: 5, 10
echo $stack->peek(); // Output: 10
