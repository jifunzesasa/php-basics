<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
       try {
        $targetDir = "uploads/"; // Directory where you want to store the uploaded images
        // check if exists and make it writable
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        // Get the file extension
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "File already exists.";
        } else {
            // Check if the file is an image
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            if (getimagesize($_FILES["image"]["tmp_name"]) !== false) {
                // Allow only specific image file types (you can customize this list)
                $allowedExtensions = ["jpg", "jpeg", "png", "gif"];
                if (in_array($imageFileType, $allowedExtensions)) {
                    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                        $fileLink = $_SERVER["HTTP_HOST"] . "/" . $targetFile;
                        echo "File uploaded successfully. Link: <a href='$fileLink'>$fileLink</a>";
                    } else {
                        echo "Error uploading the file.";
                    }
                } else {
                    echo "Invalid file type. Allowed file types: " . implode(", ", $allowedExtensions);
                }
            } else {
                echo "File is not an image.";
            }
        }
       } catch (\Throwable $th) {
              echo $th->getMessage();
       }
    } else {
        echo "Error uploading the file. Please try again.";
    }
}
