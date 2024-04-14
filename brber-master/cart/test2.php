<?php
if (isset($_POST['submit']) && isset($_FILES['uploadedImage'])) {
    $targetDir = "uploads/";  // Ensure this directory exists and is writable
    $targetFile = $targetDir . basename($_FILES["uploadedImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["uploadedImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size - example: 5MB limit
    if ($_FILES["uploadedImage"]["size"] > 5000000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["uploadedImage"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["uploadedImage"]["name"])). " has been uploaded.<br>";
            echo "<img src='$targetFile' style='max-width:100%;height:auto;'>";
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }
} else {
    echo "Invalid request.";
}
?>