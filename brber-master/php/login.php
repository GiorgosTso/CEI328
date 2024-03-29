<?php
    session_start(); // Start the session at the very beginning
    

include "config.php"; // Connect with the database

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if (empty($email_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password, typeOfUser FROM useraccount WHERE username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email); 
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password, $typeOfUser);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            $sql2 = "SELECT useraccount.username, useraccount.password, clients.name, clients.surname, clients.city, clients.email, clients.area, clients.phone FROM useraccount JOIN clients ON useraccount.id = clients.ClientID WHERE useraccount.username = ?";
                            // Store data in session variables
                            $stmt = mysqli_prepare($conn, $sql2);
                        
                        // Bind the input parameter and execute
                                mysqli_stmt_bind_param($stmt, "s", $email);
                                mysqli_stmt_execute($stmt);
                                
                                // Bind the result variables
                                mysqli_stmt_bind_result($stmt, $db_email, $db_password, $name, $surname, $city, $email, $area, $phone);
                                
                                // Fetch the results
                                if(mysqli_stmt_fetch($stmt)) {
                            // Here, you would typically verify the password before proceeding
                            if (password_verify($password, $db_password)) {
                                // Set session variables upon successful login
                                $_SESSION['username'] = $db_email;
                                $_SESSION['name'] = $name;
                                $_SESSION['surname'] = $surname;
                                $_SESSION['city'] = $city;
                                $_SESSION['email'] = $email;
                                $_SESSION['area'] = $area;
                                $_SESSION['phone'] = $phone;
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                            
                                $_SESSION["typeOfUser"] = $typeOfUser; // Store the user type
                                $_SESSION['logout_token'] = bin2hex(random_bytes(32));
                            
                            
                            
                            // Redirect user to welcome page
                                header("location: ../html/index.php");
                                exit;
                            } else {
                            // Password is not valid, display a generic error message
                                $login_err = "Invalid email or password.";
                            }
                        }
                    }
                    else {
                    // Email doesn't exist, display a generic error message
                        $login_err = "Invalid email or password.";
                    }
                } 
                else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

            // Close statement
                mysqli_stmt_close($stmt);
            }
        }
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
            
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
          <link rel="manifest" href="site.webmanifest">
          
          <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="login_123.css">
    

	<!-- CSS here -->
	
	<link rel="stylesheet" href="../assets/css/style.css">
          
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
          
     </head>
        <body>
        
        
        <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="preloader-img pere-text">
                            <img src="../assets/img/logo.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header-area header-transparent pt-20">
                <div class="main-header header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <img src="../assets/img/logo.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
             
             <div class="slider-area2">
                    <div class="slider-height2 d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="hero-cap hero-cap2 pt-70 text-center">
                                        <h2>Login</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="allForm">
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
               <i class="bi bi-eye-slash" id="togglePassword" ></i>          
               
               <span class="invalid-feedback"><?php echo $login_err; ?>
               <span class="invalid-feedback"><?php echo $password_err; ?> 
               
               
               
               </span>
                <style>
    #togglePassword {
          position: relative;
          bottom: 32px;
          left: 350px;
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
               Do you want to create an account ? <a href="../php/register.php">Signup</a>
          </div>
     </form>
        </div>
        

     
     
    <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
     <script src="login.js"></script>
</body>
</html>

