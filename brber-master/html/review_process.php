<?php
// Database configuration for XAMPP (default settings)
$servername = "localhost"; // If MySQL is running on the same machine
$username = "root"; // Default username for XAMPP MySQL
$password = ""; // Default password for XAMPP MySQL (empty by default)
$database = "southside_db"; // Name of the database you created in phpMyAdmin

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$successMessage="";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['name'];
    $numStars = $_POST['rating'];
    $content = $_POST['comment'];
    $successMessage = 'Your message has been sent successfully! Thank you for contacting us. ';
    
    // Upload photo
    $picture = '';
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $pictureName = uniqid() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $pictureName);
        $picture = $pictureName;
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO reviews (name, picture, content, numStars, date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssi", $name, $picture, $content, $numStars);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the review page after submission
        header("Location: review.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
