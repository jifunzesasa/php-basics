# Standard PHP Library (SPL)

-   [Introduction](intro.spl.php)
-   [Installing/Configuring](spl.setup.php)
    -   [Requirements](spl.requirements.php)
    -   [Installation](spl.installation.php)
    -   [Runtime Configuration](spl.configuration.php)
    -   [Resource Types](spl.resources.php)
-   [Predefined Constants](spl.constants.php)
-   [Datastructures](spl.datastructures.php)
    -   [SplDoublyLinkedList](class.spldoublylinkedlist.php) --- The SplDoublyLinkedList class
    -   [SplStack](class.splstack.php) --- The SplStack class
    -   [SplQueue](class.splqueue.php) --- The SplQueue class
    -   [SplHeap](class.splheap.php) --- The SplHeap class
    -   [SplMaxHeap](class.splmaxheap.php) --- The SplMaxHeap class
    -   [SplMinHeap](class.splminheap.php) --- The SplMinHeap class
    -   [SplPriorityQueue](class.splpriorityqueue.php) --- The SplPriorityQueue class
    -   [SplFixedArray](class.splfixedarray.php) --- The SplFixedArray class
    -   [SplObjectStorage](class.splobjectstorage.php) --- The SplObjectStorage class
-   [Iterators](spl.iterators.php)
    -   [AppendIterator](class.appenditerator.php) --- The AppendIterator class
    -   [ArrayIterator](class.arrayiterator.php) --- The ArrayIterator class
    -   [CachingIterator](class.cachingiterator.php) --- The CachingIterator class
    -   [CallbackFilterIterator](class.callbackfilteriterator.php) --- The CallbackFilterIterator class
    -   [DirectoryIterator](class.directoryiterator.php) --- The DirectoryIterator class
    -   [EmptyIterator](class.emptyiterator.php) --- The EmptyIterator class
    -   [FilesystemIterator](class.filesystemiterator.php) --- The FilesystemIterator class
    -   [FilterIterator](class.filteriterator.php) --- The FilterIterator class
    -   [GlobIterator](class.globiterator.php) --- The GlobIterator class
    -   [InfiniteIterator](class.infiniteiterator.php) --- The InfiniteIterator class
    -   [IteratorIterator](class.iteratoriterator.php) --- The IteratorIterator class
    -   [LimitIterator](class.limititerator.php) --- The LimitIterator class
    -   [MultipleIterator](class.multipleiterator.php) --- The MultipleIterator class
    -   [NoRewindIterator](class.norewinditerator.php) --- The NoRewindIterator class
    -   [ParentIterator](class.parentiterator.php) --- The ParentIterator class
    -   [RecursiveArrayIterator](class.recursivearrayiterator.php) --- The RecursiveArrayIterator class
    -   [RecursiveCachingIterator](class.recursivecachingiterator.php) --- The RecursiveCachingIterator class
    -   [RecursiveCallbackFilterIterator](class.recursivecallbackfilteriterator.php) --- The RecursiveCallbackFilterIterator class
    -   [RecursiveDirectoryIterator](class.recursivedirectoryiterator.php) --- The RecursiveDirectoryIterator class
    -   [RecursiveFilterIterator](class.recursivefilteriterator.php) --- The RecursiveFilterIterator class
    -   [RecursiveIteratorIterator](class.recursiveiteratoriterator.php) --- The RecursiveIteratorIterator class
    -   [RecursiveRegexIterator](class.recursiveregexiterator.php) --- The RecursiveRegexIterator class
    -   [RecursiveTreeIterator](class.recursivetreeiterator.php) --- The RecursiveTreeIterator class
    -   [RegexIterator](class.regexiterator.php) --- The RegexIterator class
-   [Interfaces](spl.interfaces.php)
    -   [Countable](class.countable.php) --- The Countable interface
    -   [OuterIterator](class.outeriterator.php) --- The OuterIterator interface
    -   [RecursiveIterator](class.recursiveiterator.php) --- The RecursiveIterator interface
    -   [SeekableIterator](class.seekableiterator.php) --- The SeekableIterator interface
-   [Exceptions](spl.exceptions.php)
    -   [BadFunctionCallException](class.badfunctioncallexception.php) --- The BadFunctionCallException class
    -   [BadMethodCallException](class.badmethodcallexception.php) --- The BadMethodCallException class
    -   [DomainException](class.domainexception.php) --- The DomainException class
    -   [InvalidArgumentException](class.invalidargumentexception.php) --- The InvalidArgumentException class
    -   [LengthException](class.lengthexception.php) --- The LengthException class
    -   [LogicException](class.logicexception.php) --- The LogicException class
    -   [OutOfBoundsException](class.outofboundsexception.php) --- The OutOfBoundsException class
    -   [OutOfRangeException](class.outofrangeexception.php) --- The OutOfRangeException class
    -   [OverflowException](class.overflowexception.php) --- The OverflowException class
    -   [RangeException](class.rangeexception.php) --- The RangeException class
    -   [RuntimeException](class.runtimeexception.php) --- The RuntimeException class
    -   [UnderflowException](class.underflowexception.php) --- The UnderflowException class
    -   [UnexpectedValueException](class.unexpectedvalueexception.php) --- The UnexpectedValueException class
-   [SPL Functions](ref.spl.php)
    -   [class_implements](function.class-implements.php) --- Return the interfaces which are implemented by the given class or interface
    -   [class_parents](function.class-parents.php) --- Return the parent classes of the given class
    -   [class_uses](function.class-uses.php) --- Return the traits used by the given class
    -   [iterator_apply](function.iterator-apply.php) --- Call a function for every element in an iterator
    -   [iterator_count](function.iterator-count.php) --- Count the elements in an iterator
    -   [iterator_to_array](function.iterator-to-array.php) --- Copy the iterator into an array
    -   [spl_autoload_call](function.spl-autoload-call.php) --- Try all registered __autoload() functions to load the requested class
    -   [spl_autoload_extensions](function.spl-autoload-extensions.php) --- Register and return default file extensions for spl_autoload
    -   [spl_autoload_functions](function.spl-autoload-functions.php) --- Return all registered __autoload() functions
    -   [spl_autoload_register](function.spl-autoload-register.php) --- Register given function as __autoload() implementation
    -   [spl_autoload_unregister](function.spl-autoload-unregister.php) --- Unregister given function as __autoload() implementation
    -   [spl_autoload](function.spl-autoload.php) --- Default implementation for __autoload()
    -   [spl_classes](function.spl-classes.php) --- Return available SPL classes
    -   [spl_object_hash](function.spl-object-hash.php) --- Return hash id for given object
    -   [spl_object_id](function.spl-object-id.php) --- Return the integer object handle for given object
-   [File Handling](spl.files.php)
    -   [SplFileInfo](class.splfileinfo.php) --- The SplFileInfo class
    -   [SplFileObject](class.splfileobject.php) --- The SplFileObject class
    -   [SplTempFileObject](class.spltempfileobject.php) --- The SplTempFileObject class
-   [Miscellaneous Classes and Interfaces](spl.misc.php)
    -   [ArrayObject](class.arrayobject.php) --- The ArrayObject class
    -   [SplObserver](class.splobserver.php) --- The SplObserver interface
    -   [SplSubject](class.splsubject.php) --- The SplSubject interface