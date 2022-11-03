<?php

// sha1_file
// glob('/home/Kalle/myproject/*.php')
$file = "composer.json";
$file2 = "cmposery.json";

echo $file . ' (SHA1: ' . sha1_file($file) . ')', PHP_EOL;
echo $file2 . ' (SHA1: ' . sha1_file($file2) . ')', PHP_EOL;
?>
