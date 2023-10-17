<?php

$request_file = "request.json";

// check if file exits
if (!file_exists($request_file)) {
    echo "file not found";
    exit;
}

// load request
if (!$request = file_get_contents($request_file)) {
    echo "file not loaded";
    exit;
}

// print first 50 bytes
// echo substr($request, 0, 50);exit;

try {
    $request = json_decode($request, true);
    if (!$request) {
        echo "json decode failed";
        echo json_last_error_msg();
        exit;
    }
} catch (\Throwable $th) {
    //throw $th;

}

print_r($request);exit;

$picture = array_keys($request);

echo $picture;

// // decode base64
// $decoded = base64_decode($picture);

// // save decoded file
// file_put_contents("decoded.jpg", $decoded);

// echo "done";