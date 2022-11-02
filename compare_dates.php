<?php

$date1 = new DateTime("now");
$date2 = new DateTime("tomorrow");

// echo $date1->diff($date2)->format("%a days");
echo "Date1: ". $date1->format("Y-m-d H:i:s") . PHP_EOL;
echo "Date2: ". $date2->format("Y-m-d H:i:s") . PHP_EOL;
echo "Date 1 ** is to Date 2" .PHP_EOL;

var_dump('Equal: ',$date1 == $date2);
var_dump('Less than: ',$date1 < $date2);
var_dump('Greater than',$date1 > $date2);
?>
