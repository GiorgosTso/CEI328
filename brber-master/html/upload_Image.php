<?php
// Example authentication check (simple)
session_start();
// if ($typeOfUser == 1 || $typeOfUser == 2) {
    
// }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure the file was uploaded
    if (isset($_FILES['gallery_image']) && $_FILES['gallery_image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['gallery_image'];

        // Validate file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowed_types)) {
            echo "Invalid file type.";
            exit();
        }

        // Set the upload directory
        $upload_dir = __DIR__ . '/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        // Generate a unique filename
        $filename = uniqid() . '-' . basename($file['name']);
        $destination = $upload_dir . $filename;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Save the filename to a database or configuration file
            // For simplicity, let's assume a database with a 'gallery' table and a 'image_path' column
            $db = new PDO('sqlite:southside_db'); // SQLite as an example
            $stmt = $db->prepare("INSERT INTO gallery (image_path) VALUES (:image_path)");
            $stmt->bindParam(':image_path', $filename);
            $stmt->execute();

            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading the file.";
        }
    } else {
        echo "No file uploaded.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload New Gallery Image</title>
</head>
<body>
    <h1>Upload New Gallery Image</h1>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <input type="file" name="gallery_image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>