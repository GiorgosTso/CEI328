<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload New Image</title>
</head>
<body>
    <h2>Upload a New Image</h2>
    <form action="upload_image.php" method="post" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" required>
        <label for="caption">Caption:</label>
        <input type="text" name="caption" id="caption">
        <button type="submit">Upload</button>
    </form>
</body>
</html>