# Data Structures

## Table of Contents

-   [SplDoublyLinkedList](https://www.php.net/manual/en/class.spldoublylinkedlist.php)
-   [SplStack](https://www.php.net/manual/en/class.splstack.php)
-   [SplQueue](https://www.php.net/manual/en/class.splqueue.php)
-   [SplHeap](https://www.php.net/manual/en/class.splheap.php)
-   [SplMaxHeap](https://www.php.net/manual/en/class.splmaxheap.php)
-   [SplMinHeap](https://www.php.net/manual/en/class.splminheap.php)
-   [SplPriorityQueue](https://www.php.net/manual/en/class.splpriorityqueue.php)
-   [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php)
-   [SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php)

SPL provides a set of standard data structures. They are grouped here by their underlying implementation which usually defines their general field of application.

Doubly Linked Lists
-------------------

A Doubly Linked List (DLL) is a list of nodes linked in both directions to each other. Iterator's operations, access to both ends, addition or removal of nodes have a cost of O(1) when the underlying structure is a DLL. It hence provides a decent implementation for stacks and queues.

-   [SplDoublyLinkedList](https://www.php.net/manual/en/class.spldoublylinkedlist.php)
    -   [SplStack](https://www.php.net/manual/en/class.splstack.php)
    -   [SplQueue](https://www.php.net/manual/en/class.splqueue.php)

Heaps
-----

Heaps are tree-like structures that follow the heap-property: each node is greater than or equal to its children, when compared using the implemented compare method which is global to the heap.

-   [SplHeap](https://www.php.net/manual/en/class.splheap.php)
    -   [SplMaxHeap](https://www.php.net/manual/en/class.splmaxheap.php)
    -   [SplMinHeap](https://www.php.net/manual/en/class.splminheap.php)
-   [SplPriorityQueue](https://www.php.net/manual/en/class.splpriorityqueue.php)

Arrays
------

Arrays are structures that store the data in a continuous way, accessible via indexes. Don't confuse them with PHP arrays: PHP arrays are in fact implemented as ordered hashtables.

-   [SplFixedArray](https://www.php.net/manual/en/class.splfixedarray.php)

Map
---

A map is a datastructure holding key-value pairs. PHP arrays can be seen as maps from integers/strings to values. SPL provides a map from objects to data. This map can also be used as an object set.

-   [SplObjectStorage](https://www.php.net/manual/en/class.splobjectstorage.php)