<?php

class FileUploadAPI {
    private $uploadDir;

    public function __construct($uploadDir = 'uploads/') {
        $this->uploadDir = $uploadDir;
    }

    public function handleRequest() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input');
            $data = json_decode($json);

            if ($this->isValidRequest($data)) {
                $base64Data = $data->base64_file;
                $fileData = base64_decode($base64Data);

                if ($fileData !== false) {
                    $fileName = $this->generateUniqueFileName();
                    if ($this->saveFile($fileName, $fileData)) {
                        $response = array('message' => 'File uploaded successfully.');
                    } else {
                        $response = array('error' => 'Failed to save the file.');
                    }
                } else {
                    $response = array('error' => 'Invalid base64 data.');
                }
            } else {
                $response = array('error' => 'Invalid request data.');
            }
        } else {
            $response = array('error' => 'Invalid request method. Use POST.');
        }

        echo json_encode($response);
    }

    private function isValidRequest($data) {
        return isset($data->base64_file);
    }

    private function generateUniqueFileName() {
        return uniqid() . '.jpg';
    }

    private function saveFile($fileName, $fileData) {
        return file_put_contents($this->uploadDir . $fileName, $fileData) !== false;
    }
}

// Usage
$api = new FileUploadAPI($uploadDir);
$api->handleRequest();
?>
