# PHP Type System

In PHP, the type system is nominal, which means that types are defined by their names rather than their structure. PHP also has a strong behavioral subtyping relation, which means that types must adhere to certain behavioral contracts or interfaces.

The subtyping relation in PHP is checked at __compile time__, ensuring that a subclass can be used in any context where the superclass is expected. However, the verification of types is dynamically checked at runtime, allowing for more flexibility and dynamic behavior.

PHP's type system includes various base types that can be combined to create more complex types. Some of these types can be specified using type declarations.

The built-in types in PHP include:

1.  `null` type: Represents a variable with no value or an uninitialized variable.
2.  Scalar types: These are basic data types representing single values.
    -   `bool` type: Represents a boolean value, either true or false.
    -   `int` type: Represents an integer value.
    -   `float` type: Represents a floating-point number.
    -   `string` type: Represents a sequence of characters.
3.  `array` type: Represents an ordered map that can hold multiple values.
4.  `object` type: Represents an instance of a class.
5.  `resource` type: Represents an external resource, such as a file or a database connection.
6.  `never` type: Represents a type that can never occur.
7.  `void` type: Represents the absence of any type.
8.  Relative class types: These are special types used within classes or class hierarchies.
    -   `self`: Refers to the current class.
    -   `parent`: Refers to the parent class.
    -   `static`: Refers to the class in which a method is defined (late static binding).
9.  Literal types: These are specific values that a variable can take.
    -   `false`: Represents the boolean value false.
    -   `true`: Represents the boolean value true.

In addition to the built-in types, PHP also supports user-defined types, which include:

1.  `Interfaces`: Defines a contract specifying the methods a class must implement.
2.  `Classes`: Defines a blueprint for creating objects and can contain properties and methods.
3.  `Enumerations`: Defines a set of named values.

Finally, PHP includes a `callable` type, which represents any callable function or method.