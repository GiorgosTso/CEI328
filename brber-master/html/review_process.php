<?php
// Database configuration for XAMPP (default settings)
include "../php/config.php";
// $numStars = 5;
$successMessage = "";
$picture = '';
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $name = $_POST['name'];
    $numStars = $_POST['rating'];
    $content = $_POST['comment'];
   
    $isHidden = 0;
    $successMessage = 'Your message has been sent successfully! Thank you for contacting us. ';
    
    // Upload photo
    if (isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != "") {
        $targetDir = "uploads/";  // Ensure this directory exists and is writable
        $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    
        // Check file size - example: 5MB limit
        if ($_FILES["photo"]["size"] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
            echo "Sorry, only JPG, JPEG, WEBP, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
        } else {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " has been uploaded.<br>";
                $picture = $targetFile; // Update to the actual path of the uploaded file
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }


    // $logDateTime = date("Y-m-d H:i:s");
    // $logAction = "User: " .$name. " made a " .$numStars. " star/'s review"; 

    // $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    // $result2 =mysqli_query($conn, $query2);

    $currentDate = date('Y-m-d');
    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO reviews (name, picture, content, numStars, date, isHidden) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die('MySQL prepare error: ' . $conn->error);
        }

        $stmt->bind_param("sssisi", $name, $picture, $content, $numStars, $currentDate, $isHidden);
        if ($stmt->execute()) {
            header("Location: review.php?success=1"); // Use a GET parameter for success message
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
