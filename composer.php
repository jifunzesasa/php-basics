<?php
$path = "composer.json";
if (file_exists($path)) {
    $composer = file_get_contents('composer.json');
    try {
        $composerArr = json_decode($composer, true);
        if ($composerArr == null) {
            throw new \JsonException(json_last_error_msg());
        }
        // print_r($composerArr['require']);
        print_r($composerArr);
    } catch (\JsonException $th) {
        echo 'Error: ' . $th->getMessage() . PHP_EOL;
    } catch (\Throwable $th) {
        echo 'Error: ' . $th->getMessage() . PHP_EOL;
    }
} else {
    echo "File {$path} not found";
}
