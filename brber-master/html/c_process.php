<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../php/PHPMailer/src/Exception.php';
require __DIR__ . '/../php/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../php/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

include "../php/config.php";

$successMessage = " ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, surname, email, message) VALUES ('$name', '$surname', '$email', '$message')";
    
    $logDateTime = date("Y-m-d H:i:s");
    $logAction = "User: " .$name. " has send an email"; 

    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    $result2 =mysqli_query($conn, $query2);

    if ($conn->query($sql) === TRUE) {
        
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
            $mail->setFrom($email,$name);
            $mail->addAddress("rafaant26@gmail.com"); 
            $mail->addReplyTo($email,$name);

            // Content
            $mail->isHTML(false); 
            $mail->Subject = 'New Contact Message';
            $mail->Body    = "Name: $name\nSurname: $surname\nEmail: $email\nMessage: $message";

            $mail->send();
             $successMessage = 'Message sent successfully! ';
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
            }
    //Close database connection
    $conn->close();
    ?>











