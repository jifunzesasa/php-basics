<?php

/**
 * Iterable class
 * @author Alpha Olomi <>
 * @version 1.0.0
 * @license MIT
 * 
 */
class MyIterator implements Iterator
{
  /**
   * An array containing the entries
   * @var array data
   */
  private array $items = [];

  /**
   * Position in the interator
   * @var int pointer
   */
  private int $pointer = 0;

  /**
   * Construct
   * @param array $items
   */
  public function __construct(array $items)
  {
    $this->items = array_values($items);
  }

  /**
   * Rewind the iterator to the first element
   * @return void
   */
  public function current()
  {
    return $this->items[$this->pointer];
  }

  /**
   * Return the key of the current element
   * @return int
   */
  public function key()
  {
    return $this->pointer;
  }

  /**
   * Move forward to next element
   * @return void
   */
  public function next(): void
  {
    $this->pointer++;
  }

  /**
   * Check if there is a current element after calls to rewind() or next()
   * @return boolean
   */
  public function rewind(): void
  {
    $this->pointer = 0;
  }

  /**
   * Check if current position is valid
   * @return boolean
   */
  public function valid(): bool
  {
    return $this->pointer < count($this->items);
  }
}

/**
 * Print the iterables
 * @param iterable $myIterable
 * @return void
 */
function printIterable(iterable $myIterable)
{
  foreach ($myIterable as $item) {
    echo $item;
  }
}

// Use the iterator as an iterable
$iterator = new MyIterator(["a", "b", "c"]);
printIterable($iterator);
