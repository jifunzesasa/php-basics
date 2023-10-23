# Introduction to MySQL Storage Engines

## Storage engines


| Storage Engine | Description |
| --- | --- |
| [CSV](http://localhost/phpmyadmin/index.php?route=/server/engines/CSV) | Stores tables as CSV files |
| [MRG_MyISAM](http://localhost/phpmyadmin/index.php?route=/server/engines/MRG_MyISAM) | Collection of identical MyISAM tables |
| [MEMORY](http://localhost/phpmyadmin/index.php?route=/server/engines/MEMORY) | Hash based, stored in memory, useful for temporary tables |
| [Aria](http://localhost/phpmyadmin/index.php?route=/server/engines/Aria) | Crash-safe tables with MyISAM heritage. Used for internal temporary tables and privilege tables |
| [MyISAM](http://localhost/phpmyadmin/index.php?route=/server/engines/MyISAM) | Non-transactional engine with good performance and small data footprint |
| [SEQUENCE](http://localhost/phpmyadmin/index.php?route=/server/engines/SEQUENCE) | Generated tables filled with sequential values |
| [InnoDB](http://localhost/phpmyadmin/index.php?route=/server/engines/InnoDB) | Supports transactions, row-level locking, foreign keys and encryption for tables |
| [PERFORMANCE_SCHEMA](http://localhost/phpmyadmin/index.php?route=/server/engines/PERFORMANCE_SCHEMA) | Performance Schema |

1.  CSV (Comma-Separated Values):

    -   Stores tables as CSV files.
    -   Suitable for storing data in a simple, human-readable format.
    -   Generally used for data interchange rather than as a primary storage engine.
2.  MRG_MyISAM (Merge MyISAM):

    -   A collection of identical MyISAM tables.
    -   Allows you to manage multiple MyISAM tables as a single entity, simplifying queries across these tables.
3.  MEMORY:

    -   Hash-based storage engine that stores tables in memory.
    -   Useful for temporary tables or caching data as it offers extremely fast read and write operations.
    -   Data is lost when the MySQL server is restarted.
4.  Aria:

    -   Provides crash-safe tables with MyISAM heritage.
    -   Used for internal temporary tables and privilege tables in MySQL.
    -   Offers some performance improvements over MyISAM.
5.  MyISAM:

    -   A non-transactional storage engine with good performance and a small data footprint.
    -   Suitable for read-heavy applications but not recommended for write-intensive applications or applications requiring ACID compliance.
6.  SEQUENCE:

    -   Used for generating tables filled with sequential values.
    -   Often employed to generate unique identifiers or sequences of numbers.
7.  InnoDB:

    -   A popular storage engine that supports transactions, row-level locking, foreign keys, and encryption for tables.
    -   Suitable for applications that require ACID compliance, data integrity, and reliability.
8.  PERFORMANCE_SCHEMA:

    -   A storage engine used for performance monitoring and profiling, rather than for storing application data.
    -   Helps database administrators monitor the performance of the MySQL server and identify bottlenecks.