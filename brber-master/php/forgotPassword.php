<?php
session_start();
include "config.php";

$email = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senderEmail = trim($_POST['email']);
    
    if (empty($senderEmail)) {
        // Email input is empty, set error message and redirect
        $_SESSION['email_err'] = "Please enter an email";
        header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"]));
        exit;
    } else {
        // Prepare a select statement to look up the email
        $sql = "SELECT id FROM useraccount WHERE username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            // Set parameters
            $param_email = $senderEmail;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Email exists, redirect to password reset page
                    $_SESSION['email'] = $senderEmail; // Store email in session for later use
                    header("Location: codeVerification.php");
                    exit;
                } else {
                    // Email doesn't exist, set error message and redirect
                    $_SESSION['email_err'] = "Sorry, we couldn't find your account";
                    header("Location: " . htmlspecialchars($_SERVER["PHP_SELF"]));
                    exit;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
} else {
    // Not a POST request, clear previous error messages if any
    $email_err = isset($_SESSION['email_err']) ? $_SESSION['email_err'] : "";
    unset($_SESSION['email_err']); // Clear the error message in session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="forgotPassword.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="forgot-password">
    <div class="card-body">
        <div class="mb-4">
            <h5>Forgot Password?</h5>
            <p class="mb-2">Enter your registered email ID to reset the password</p>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" name="email" placeholder="Enter Your Email">
                <span class="invalid-feedback"><?php echo $email_err ?></span>
            </div>
            <div class="mb-3 d-grid">
                <input type="submit" class="btn btn-primary" value="Reset Password">
            </div>
        </form>
    </div>
</body>
</html>
