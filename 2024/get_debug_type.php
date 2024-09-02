<?php

echo "null): " . get_debug_type(null) . PHP_EOL;
echo "true): " . get_debug_type(true) . PHP_EOL;
echo "1): " . get_debug_type(1) . PHP_EOL;
echo "0.1: " . get_debug_type(0.1) . PHP_EOL;
echo "foo: " . get_debug_type("foo") . PHP_EOL;
echo "[]): " . get_debug_type([]) . PHP_EOL;

$fp = fopen(__FILE__, 'rb');
echo "fp: " . get_debug_type($fp) . PHP_EOL;
fclose($fp);
echo "fp: " . get_debug_type($fp) . PHP_EOL;

echo "new stdClass: " . get_debug_type(new stdClass) . PHP_EOL;
echo "new class: " . get_debug_type(new class {}) . PHP_EOL;
