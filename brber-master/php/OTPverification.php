<?php
session_start();
    
include "config.php";

$code = "";
$code_err = "";

$emailSubject = $_SESSION['email'] ?? '';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty(trim($_POST["code"]))) {
        $code_err = "Please insert the code.";
    } else {
        $code = trim($_POST["code"]);
        
        if(isset($_SESSION['otp'], $_SESSION['otp_expiry']) && $code == $_SESSION['otp'] && time() < $_SESSION['otp_expiry']) {
            // OTP is correct and not expired
            echo "<p>OTP verification successful. You can now reset your password.</p>";
            // Proceed with password reset process

            // Unset OTP and expiry from the session after successful verification
            unset($_SESSION['otp'], $_SESSION['otp_expiry']);
            
            // Optionally, redirect to a new password setup page
            // header("Location: newPassword.php");
            // exit;
        } else {
            // Either the code is incorrect, expired, or not set
            $code_err = "The verification code is incorrect or expired.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="forgotPassword.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="forgot-password">
    <div class="card-body">
        <div class="mb-4">
            <h5>Code Verification</h5>
            <p class="mb-2">We have sent a verification code to your email: <strong><?php echo htmlspecialchars($emailSubject); ?></strong>.
              <br>Enter it below to reset your password.</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="code" class="form-label">Verification Code</label>
                <input type="text" id="code" name="code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $code; ?>" placeholder="Enter Code">
                <span class="invalid-feedback"><?php echo $code_err; ?></span>
            </div>
            <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-primary">Verify Code</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
