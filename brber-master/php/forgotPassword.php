 
    session_start();
    
    // if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    //     header("location:html/index.php");
    //     exit;
    //}
   
    
   
    
    include "config.php";
    $name = "Southside barbershop";
    $error_message = "";
    $success_message = "";
    $email = "";
    $email_err = "";
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $senderEmail = $_POST['email'];
      $_SESSION['email'] = $senderEmail;
        if(empty(trim($_POST["email"]))) {
            $email_err = "Please enter an email";
        }
        else {
            $sql = "SELECT id From useraccount WHERE username = ?";
       
            if($stmt = mysqli_prepare($conn, $sql)){
                 mysqli_stmt_bind_param($stmt, "s", $param_email);
                 $param_email = trim($_POST["email"]);
               
               if(mysqli_stmt_execute($stmt)){
               
                    mysqli_stmt_store_result($stmt);
                    
                    if(!(mysqli_stmt_num_rows($stmt) == 1)){
                    
                         $email_err = "Sorry, we couldn't find your account";
                         
                    }
                    else {
                     

                     

                      $to = "andreasggchristou@gmail.com";
                      $subject = "Subject of your email";
                      $message = "This is the content of your email.";

// Additional headers
$headers = "From: your-email@example.com\r\n";
$headers .= "Reply-To: your-email@example.com\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully .";
} else {
    echo "Failed to send email.";
}
                         
                         //header("location: codeVerification.php");
                    }
                    
                }
                else {
                    echo "Oops something went wrong, please try again later.";
               }     
               mysqli_stmt_close($stmt);
            }
        }  
        //edo mporoun na mpoun kai alla validation
    }
    

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

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
                <p class="mb-2">Enter your registered email ID to reset the password
                </p>
              </div>
              <form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" id="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" name="email" placeholder="Enter Your Email">
                  <span class="invalid-feedback"><?php echo $email_err ?></span>
                </div>
                <div class="mb-3 d-grid">
                  <input type="submit" class="btn btn-primary">
                    <a href="codeVerification.php">Reset Password</a>
                  </input>
                </div>
                <span>Don't have an account? <a href="createAccount.php">sign in</a></span>
              </form>
            </div>
          </div>
</html>

