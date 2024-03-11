<?php
include "config.php";//connect with the database
          
//define the variables
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

     if(empty(trim($_POST["email"]))){
          $email_err = "Please enter your email";
     }
     else {
          $sql = "SELECT id From userAcccount WHERE email = ?";
     
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
     //validation for password
     $regex = '/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]+$/';
     
     if(empty(trim($_POST["password"]))) {
          $password_err = "Please enter your passaword";
     }
     elseif(strlen(trim($_POST["password"])) <= 6) {
          $password_err = "Password must be at least 6 characters";
     }
     elseif(!preg_match($regex,$password)) {
          $password_err = "Password must contain at least one number or one character!";
     }
     else {
          $password = trim($_POST["password"]);
     }
     //validation for confirm password
     if(empty(trim($_POST["confirmPassword"]))) {
         $confirm_password_err = "Please enter your password";
     }
     else {
          $confirm_password = trim($_POST["confirmPassword"]);
     
          if(empty($confirm_password_err) && $password != $confirm_password) {
               $confirm_password_err = "The password did not match";
		}
     }
     //insert values in the database 
     if(empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
     
          $sql = "INSERT INTO userAccount(username,password) values(?,?)";
     
          if($stmt = mysqli_prepare($conn,$sql)) {
	          mysqli_stmt_bind_param($stmt, "ss",$param_email,$param_password);
	          
	          $param_email = $email;
	          $param_password = $password;
	          
	          if(mysqli_stmt_execute($stmt)) {
	               header("location:login.php");
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
               <input type="email" name="email" value= <?php echo $email ?> class="form-control" placeholder="Enter email">
               <span class="invalid-feedback"><?php echo $email_err; ?></span>
    
          </div>
          <div class="form-group">
               <label for="exampleInputPassword1">Password</label>
               <input type="password" name="password" value= <?php echo $password ?> class="form-control" placeholder="Password">
               <span class="invalid-feedback"><?php echo $password_err; ?></span>
          </div>
          
          <div class="form-group">
               <label for="exampleInputPassword1">Confirm password</label>
               <input type="password" name="confirmPassword" value= <?php echo $confirm_password ?> class="form-control" placeholder="Confirm password">
               <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
          </div>
          
          <div class="pass-submit">
               <a href="forgotPassword.php">Forgot Password?</a>
               <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          
          <div class="signup_link">
               Do you want to create an account ? <a href="createAccount.php">Signup</a>
          </div>
     </form>
  
</body>
</html>