<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
include "config.php";//connect with the database
          
//define the variables
$email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

     if(empty(trim($_POST["email"]))){
          $email_err = "Please enter your email";
     }
     else {
          $sql = "SELECT id From useraccount WHERE username = ?";
     
          if($stmt = mysqli_prepare($conn, $sql)){
               mysqli_stmt_bind_param($stmt, "s", $param_email);
               
               $param_email = trim($_POST["email"]);
               
               if(mysqli_stmt_execute($stmt)){
               
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                    
                         $email_err = "This email is already taken";
                         
                    }
                    else {
                         $email = trim($_POST["email"]);
                    }
               }
                    
               else {
                    echo "Oops something went wrong, please try again later.";
               }     
               mysqli_stmt_close($stmt);
          }
          
     }  
     //validaiton for the password 
     $regex = '/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/';
     
     if(empty(trim($_POST["password"]))) {
          $password_err = "Please enter your passaword";
     }
     elseif(strlen(trim($_POST["password"])) < 6) {
          $password_err = "Password must be at least 6 characters";
     }
     elseif(preg_match($regex,$password)) {
          $password_err = "Password must contain at least one number or one character!";
     }
     else {
          $password = trim($_POST["password"]);
     }
     //validation for confirm password
     
     //insert values in the database 
     if(empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
     
          $sql = "INSERT INTO useraccount(username,password) values(?,?)";
     
          if($stmt = mysqli_prepare($conn,$sql)) {
	          mysqli_stmt_bind_param($stmt, "ss",$param_email,$param_password);
	          
	          $param_email = $email;
	          $param_password = $password;
	          
	          if(mysqli_stmt_execute($stmt)) {
	               header("location:index.html");
	          }
	          else {
	               echo "Oops something went wrong. Please try again later.";
	          }
	          mysqli_stmt_close($stmt);
          }
	}
	mysqli_close($conn);
}
  
?>

<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Login Page</title>
          <link rel="stylesheet" href="login.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     </head>
<body>
  
<form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
     <h1>Login to your account</h1>
          <div class="form-group">
               <label for="exampleInputEmail1">Email address</label>
               <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter email">
               <span class="invalid-feedback"><?php echo $email_err; ?></span>
    
          </div>
          <div class="form-group">
               <label for="exampleInputPassword1">Password</label>
               <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password">
               <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          
          <div class="pass-submit">
               <a href="forgotPassword.php">Forgot Password?</a>
               <input type="submit" value="Login" class="btn btn-primary"></input>
          </div>
          
          <div class="signup_link">
               Do you want to create an account ? <a href="createAccount.php">Signup</a>
          </div>
     </form>
  
</body>
</html>