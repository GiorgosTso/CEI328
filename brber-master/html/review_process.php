<?php
require("../php/config.php");
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    
    // Upload photo
    $photo = '';
    if ($_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photoName = uniqid() . '_' . $_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photoName);
        $photo = $photoName;
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO reviews (name, picture, content, numStars, date) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssi", $name, $photo, $comment, $rating);

    if (isset($_SESSION['email'])) 
    {
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
    }
    $logDateTime = date("Y-m-d H:i:s");
    $logAction = "User: " .$email. " has added a review"; 

    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    $result2 =mysqli_query($conn, $query2);
    
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

