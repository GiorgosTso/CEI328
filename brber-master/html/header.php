<?php 
     session_start();
    
//     header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

// Check if the user is logged in, else redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../php/login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">
	<link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../assets/css/themify-icons.css">
	<link rel="stylesheet" href="../assets/css/slick.css">
	<link rel="stylesheet" href="../assets/css/nice-select.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	
</head>
<body>
    
</body>
</html>


<header>
        <!--? Header Start -->
        <div class="header-area header-transparent pt-20">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="../html/index.php"><img src="../assets/img/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class=""><a href="../html/index.php">Home</a></li>
                                            <li><a href="../html/about.php">About</a></li>
                                            <li><a href="../html/services.php">Services</a></li>
                                            <li><a href="../cart/index.php">Orders</a></li>
                                            <li><a href="../html/appointment.html">Appointments</a></li>
                                            <li><a href="../html/review.php">Review</a></li>
                                            <li class = ""><a href="../html/contact.php">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                
                                    <?php
                                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === false  ){
                                        echo '<div class="header-right-btn f-right d-none d-lg-block ml-30">';//den emfanizei to login kai to sign up
                                        echo '<a href="../php/login.php" class="btn header-btn">Login</a>';
                                        echo '</div>';
                                        echo '<div class="header-right-btn f-right d-none d-lg-block ml-30">';
                                        echo '<a href="register.php" class="btn header-btn">Sign Up</a>';
                                        echo '</div>';
                                        echo '</div>';
                                     }
                                    ?>
                                    <form action="../php/logout.php" method="post">
                                        <input type="hidden" name="logout_token" value="<?php echo $_SESSION['logout_token']; ?>">
                                        <button type="submit" name="logout_btn" class="btn btn-danger">Logout</button>
                                    </form>
                                    
                                </div>
                                
                        </div>   
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    