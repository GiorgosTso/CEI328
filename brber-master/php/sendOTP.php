<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Generate OTP
$otp = rand(100000, 999999);

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com'; // Set your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'agnostosagnostos6@gmail.com';   // SMTP username
    $mail->Password   = 'olsuinnitjjzhrme';   // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587; // TCP port to connect to

    // Sender info
    $mail->setFrom('agnostosagnostos6@gmail.com', 'SouthSide BarberShop');
    $mail->addAddress($senderEmail);
    $mail->isHTML(true);
    $mail->Subject = 'Your Password Reset OTP';
    $mail->Body    = "Your OTP for password reset is: $otp.\nIt is valid for 5 minutes. Please do not share this OTP with anyone.";
    $mail->send();
    echo 'Message has been sent';

    // Store OTP and expiry in session if mail was successfully sent
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiry'] = time() + 300; // OTP expires in 5 minutes
    $emailSent = true;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $emailSent = false;
}

?>