<?php
 
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: html/index.php");
//     exit;
// }
include "config.php";//connect with the database
          
//define the variables
$email = $password = "";
$email_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

     if(empty(trim($_POST["email"]))){//check if the email is in the database
          $email_err = "Please enter your email";
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
                       $email = trim($_POST["email"]);
                  }
                  
              }
              else {
                  echo "Oops something went wrong, please try again later.";
             }     
             mysqli_stmt_close($stmt);
          }
     }
     //validation for the password
     
     if(empty(trim($_POST["password"]))) {
          $password_err = "Please enter your password";
     }
     else {
          $password = trim($_POST["password"]);
     }
	//validation if the password and the username is for the same user
	
	if(empty($username_err) && empty($password_err)){
          // Prepare a select statement
          $sql = "SELECT id, username, password FROM useraccount WHERE username = ?";
          
          if($stmt = mysqli_prepare($conn, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "s", $param_email);
              
              // Set parameters
              $param_email = $email;
              
              // Attempt to execute the prepared statement
              if(mysqli_stmt_execute($stmt)){
                  // Store result
                  
                  mysqli_stmt_store_result($stmt);
                  
                  // Check if username exists, if yes then verify password
                  if(mysqli_stmt_num_rows($stmt) == 1){                    
                      // Bind result variables
                      mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                      if(mysqli_stmt_fetch($stmt)){
                      
                          if(password_verify($password, $hashed_password)){
                              // Password is correct, so start a new session
                              
                              
                              session_start();
                              
                              // Store data in session variables
                              $_SESSION["loggedin"] = true;
                              $_SESSION["id"] = $id;
                              $_SESSION["email"] = $email;                            
                              
                              // Redirect user to welcome page
                              header("location:../html/index.html");
                          } else{
                              
                              // Password is not valid, display a generic error message
                              $login_err = "Invalid email or password.";
                          }
                      }
                  } else{
                      // Username doesn't exist, display a generic error message
                      $login_err = "Invalid email or password.";
                  }
              } else{
                  echo "Oops! Something went wrong. Please try again later.";
              }
  
              // Close statement
              mysqli_stmt_close($stmt);
          }
     }
      
      // Close connection
      mysqli_close($conn);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Login Page</title>
          <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
          <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">
          <link rel="stylesheet" href="login.css">
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
          
     </head>
<body>

 
                   
     
  
<form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
     <h1>Login to your account</h1>
          <div class="form-group">
               <label for="exampleInputEmail1">Email address</label>
               <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?><?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Enter email">
               <span class="invalid-feedback"><?php echo $login_err; ?>
               <span class="invalid-feedback"><?php echo $email_err; ?></span>
    
          </div>
          <div class="form-group">
               <label for="exampleInputPassword1">Password</label>

               <input type="password" name="password" id="password"  class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?><?php echo (!empty($login_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password"/>          
               
               <span class="invalid-feedback"><?php echo $login_err; ?>
               <span class="invalid-feedback"><?php echo $password_err; ?> 
               
               
               
               </span>
                <style>
    #togglePassword {
          position: relative;
          bottom: 32px;
          left: 405px;
          cursor: pointer;
          color: black; /* Default color */
    }

    #togglePassword:active {
        color: grey; /* Change to desired hover color prepei na do ti prepei na kamo dioti den me afinei na mpei to design ston allo fakelo*/
    }
</style>  
               
          </div>
          
          <div class="pass-submit">
               <a href="forgotPassword.php">Forgot Password?</a>
               <input type="submit" value="Login" class="btn btn-primary"></input>
          </div>
          
          <div class="signup_link">
               Do you want to create an account ? <a href="createAccount.php">Signup</a>
          </div>
     </form>
     <script src="login.js"></script>
</body>
</html>

