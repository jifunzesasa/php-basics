<?php
header('Content-Type: application/json');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON data
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    // Check if 'base64_file' field exists in the JSON data
    if (isset($data->base64_file)) {
        $base64Data = $data->base64_file;
        
        // Decode the base64 data
        $fileData = base64_decode($base64Data);

        if ($fileData !== false) {
            // Specify the directory where you want to save the uploaded files
            $uploadDir = 'uploads/';
            $fileName = uniqid() . '.jpg'; // You can use any desired filename and extension

            // Save the decoded file to the uploads directory
            if (file_put_contents($uploadDir . $fileName, $fileData) !== false) {
                $response = array('message' => 'File uploaded successfully.');
            } else {
                $response = array('error' => 'Failed to save the file.');
            }
        } else {
            $response = array('error' => 'Invalid base64 data.');
        }
    } else {
        $response = array('error' => 'No base64_file field found in the JSON data.');
    }
} else {
    $response = array('error' => 'Invalid request method. Use POST.');
}

echo json_encode($response);
?>
