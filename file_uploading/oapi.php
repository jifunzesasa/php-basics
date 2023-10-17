<?php

class FileUploadAPI {
    private $uploadDir;

    public function __construct($uploadDir) {
        $this->uploadDir = $uploadDir;
    }

    public function handleRequest() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(array('error' => 'Invalid request method. Use POST.'));
            return;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json);

        if (!$this->isValidRequest($data)) {
            echo json_encode(array('error' => 'Invalid request data.'));
            return;
        }

        $base64Data = $this->extractBase64Data($data->base64_file);
        $fileData = base64_decode($base64Data);

        if ($fileData === false) {
            echo json_encode(array('error' => 'Invalid base64 data.'));
            return;
        }

        $fileName = $this->generateUniqueFileName();

        if (!$this->saveFile($fileName, $fileData)) {
            echo json_encode(array('error' => 'Failed to save the file.'));
            return;
        }

        echo json_encode(array('message' => 'File uploaded successfully.'));
    }

    private function isValidRequest($data) {
        return isset($data->base64_file);
    }

    private function extractBase64Data($base64String) {
        $parts = explode(',', $base64String);
        return count($parts) === 2 ? $parts[1] : $base64String;
    }

    private function generateUniqueFileName() {
        return uniqid() . '.jpg';
    }

    private function saveFile($fileName, $fileData) {
        return file_put_contents($this->uploadDir . $fileName, $fileData) !== false;
    }
}

// Usage
$uploadDir = 'uploads/';
$api = new FileUploadAPI($uploadDir);
$api->handleRequest();
?>
