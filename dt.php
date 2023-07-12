<?php

try {
    $date = new DateTime('2000-01-01');
    $dateFormat = DateTime::createFromFormat('j-M-Y', '15-Feb-2009');
    $dateTz = new DateTime('2000-01-01', new DateTimeZone('Africa/Dar_es_salaam'));
} catch (Exception $e) {
    echo $e->getMessage();
    exit(1);
}

echo $date->format('Y-m-d');
?>
