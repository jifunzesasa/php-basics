<?php
$path = "composer.json";
if (file_exists($path)){
    $composer = file_get_contents('composer.json');
    // echo $composer;
    try {
    $composerArr = json_decode($composer,true);
        print_r($composerArr['require']);
    } catch (\Throwable $th) {
        //throw $th;
    }
    // echo ($composerArr['require']);
} else {
    echo "File {$path} not found";
}
