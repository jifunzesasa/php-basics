<?php

/**
 * Class Node
 *
 * Represents a node in the LinkedList.
 */
class Node
{
    /** @var mixed The data stored in the node. */
    public $data;
    
    /** @var Node|null The next node in the LinkedList. */
    public ?Node $next;

    /**
     * Node constructor.
     *
     * @param mixed $data The data to be stored in the node.
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->next = null;
    }
}

/**
 * Class LinkedList
 *
 * Represents a LinkedList data structure.
 */
class LinkedList
{
    /** @var Node|null The head node of the LinkedList. */
    private ?Node $head;

    /** @var int The size of the LinkedList. */
    private int $size;

    /**
     * LinkedList constructor.
     */
    public function __construct()
    {
        $this->head = null;
        $this->size = 0;
    }

    /**
     * Inserts an element at the beginning of the LinkedList.
     *
     * @param mixed $data The data to be inserted.
     */
    public function insertAtBeginning($data): void
    {
        $newNode = new Node($data);
        $newNode->next = $this->head;
        $this->head = $newNode;
        $this->size++;
    }

    /**
     * Inserts an element at the end of the LinkedList.
     *
     * @param mixed $data The data to be inserted.
     */
    public function insertAtEnd($data): void
    {
        $newNode = new Node($data);

        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }

        $this->size++;
    }

    /**
     * Removes the first occurrence of the given data from the LinkedList.
     *
     * @param mixed $data The data to be removed.
     */
    public function remove($data): void
    {
        if ($this->head === null) {
            return;
        }

        if ($this->head->data === $data) {
            $this->head = $this->head->next;
            $this->size--;
            return;
        }

        $current = $this->head;
        while ($current->next !== null) {
            if ($current->next->data === $data) {
                $current->next = $current->next->next;
                $this->size--;
                return;
            }
            $current = $current->next;
        }
    }

    /**
     * Checks if the LinkedList is empty.
     *
     * @return bool True if the LinkedList is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return $this->head === null;
    }

    /**
     * Returns the size of the LinkedList.
     *
     * @return int The size of the LinkedList.
     */
    public function getSize(): int
    {
        return $this->size;
    }
}



// Create a new LinkedList instance
$linkedList = new LinkedList();

// Insert elements at the beginning
$linkedList->insertAtBeginning('Apple');
$linkedList->insertAtBeginning('Banana');
$linkedList->insertAtBeginning('Cherry');

// Insert elements at the end
$linkedList->insertAtEnd('Dates');
$linkedList->insertAtEnd('Elderberry');

// Check if the LinkedList is empty
if ($linkedList->isEmpty()) {
    echo "LinkedList is empty.";
} else {
    echo "LinkedList is not empty.";
}

// Get the size of the LinkedList
echo "Size of the LinkedList: " . $linkedList->getSize() . PHP_EOL;

// Remove an element
$linkedList->remove('Banana');

// Get the size of the LinkedList after removal
echo "Size of the LinkedList after removal: " . $linkedList->getSize() . PHP_EOL;
