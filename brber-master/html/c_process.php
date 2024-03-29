<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../php/PHPMailer/src/Exception.php';
require '../php/PHPMailer/src/PHPMailer.php';
require '../php/PHPMailer/src/SMTP.php';

// Initialize PHPMailer
$mail = new PHPMailer(true);


//include "config.php";

// Check connection
//if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
//}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Save message to database
    //$sql = "INSERT INTO messages (name, surname, email, message) VALUES ('$name', '$surname', '$email', '$message')";
    //if ($conn->query($sql) === TRUE) {
        // Message saved successfully, send email notification using PHPMailer

        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'rafaant26@gmail.com'; // SMTP username
            $mail->Password = 'paab twrv dlum zwng'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom($email);
            $mail->addAddress('rafaant26@gmail.com'); 

            // Content
            $mail->isHTML(false); 
            $mail->Subject = 'New Contact Message';
            $mail->Body    = "Name: $name\nSurname: $surname\nEmail: $email\nMessage: $message";

            $mail->send();
             $successMessageyyy = 'Message sent successfully! ';
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    if (!empty($successMessage) || !empty($errorMessage)) { ?>
        <div class="message-container">
            <?php if (!empty($successMessage)) { ?>
                <div class="success-message"><?php echo $successMessage; ?></div>
            <?php } ?>
            <?php if (!empty($errorMessage)) { ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php } ?>
            <a href="index.php">Back to Homepage</a>
        </div>
    <?php } 
  

    // Close database connection
    //$conn->close();
    ?>











