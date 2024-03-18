<?php
session_start();
    
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
// 	header("location:html/index.php");
// 	exit;
// }
$emailSubject = $_SESSION['email'] ?? '';
include "config.php";

  $code = "";
  $code_err = "";
  $email = "";
  
  
  echo "The email is " . $emailSubject . ".<br>";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty(trim($_POST["code"]))) {
		$code_err = "Insert the code";
	}
	else {
		$code = $_POST["code"];
		
		$code = rand(100000,999999);
	}
	
	
	
	
	if(empty($code_err)){
		
	}
}
        
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Code verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="forgotPassword.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

  </head>

  <body>
  <form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
          <div class="forgot-password">
            <div class="card-body">
              <div class="mb-4">
                <h2>Enter your verification code</h2>
                <p class="mb-2">We have sent a verification code to:
                </p>
              </div>
              
                <div class="mb-3">
                  <label for="" class="form-label">Enter the code verification</label>
                  <input type="text" id="" name="code" class="form-control <?php echo (!empty($code_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $code; ?>" name="email" placeholder="Enter Your Email">
                  <span class="invalid-feedback"><?php echo $code_err ?></span>
                </div>
                <div class="mb-3 d-grid">
                  <button type="submit" class="btn btn-primary">
                    Reset Password
                  </button>
                </div>
                <span>Don't have an account? <a href="sign-in.html">sign in</a></span>
              </form>
            </div>
          </div>
</html>