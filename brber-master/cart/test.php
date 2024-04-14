<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload and Display Image</title>
</head>
<body>
    <h2>Upload an Image</h2>
    <form action="test2.php" method="post" enctype="multipart/form-data">
        <label for="fileUpload">Select an image to upload:</label>
        <input type="file" name="uploadedImage" id="fileUpload" required>
        <button type="submit" name="submit">Upload Image</button>
    </form>
</body>
</html>
