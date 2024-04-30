<?php
// upload_image.php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $upload_dir = 'uploads/';
    $file_name = basename($_FILES['image']['name']);
    $file_path = $upload_dir . $file_name;
    $image_caption = $_POST['caption'];

    // Validate file type (e.g., only allow JPG, PNG, etc.)
    $allowed_types = ['image/jpeg', 'image/png'];
    if (in_array($_FILES['image']['type'], $allowed_types)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
            // Connect to the database and insert record
            $db = new PDO('sqlite:southside.db'); 
            $stmt = $db->prepare("INSERT INTO gallery (image_path, caption) VALUES (:image_path, :caption)");
            $stmt->execute(['image_path' => $file_path, 'caption' => $image_caption]);

            echo "Image uploaded successfully.";
        } else {
            echo "Error moving the file.";
        }
    } else {
        echo "Invalid file type.";
    }
} else {
    echo "No file uploaded.";
}
?>