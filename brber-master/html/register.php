<?php

session_start();
include("../php/config.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $area = $_POST['area'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    $typeOfUser = 3;
    $password = $_POST['password'];
    
    $hash = password_hash ($password, PASSWORD_DEFAULT);
    
    
    if(!empty($email) && !empty($password))
    {

        $query1 = "insert into useraccount(username, password, typeOfUser)values ('$email', '$hash', '3')";
        $result1 = mysqli_query($conn, $query1);

        $last_user_id = mysqli_insert_id($conn);

        $query = "insert into clients (id,name,surname,city,email,area,phone) 
        values ('$last_user_id','$name','$surname','$city','$email','$area','$phone')";
        $result = mysqli_query($conn, $query);


        $logDate = date("Y-m-d");
        $logAction = "New user created: " . $username; 

        $query3 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDate', '$logAction')";
        $result3 =mysqli_query($conn, $query3);

        header("Location: ../php/login.php?Success=Account created successfully");
        die();
    }else
    {
        echo "Please enter some valid information!";
    }

    $_SESSION["name"] = $_POST['name'];
}
?>
<!DOCTYPE html>
<html lang="en">
     <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Register Page</title>
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
            <div class="header-area header-transparent pt-20">
                <div class="main-header header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                              <div class="logo">
                                <img src="../assets/img/logo.png" alt="">
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
                                    <div class="hero-cap hero-cap2 pt-70 text-center" style="position: relative; top: -180px;">
                                        <h2>Register your account</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <style>
      .red-asterisk {
        color: red;
      }
    </style>
  <section class="vh-100 bg-image" style="background-image: url('../css/slider.jpg')" >
    <div class="mask d-flex align-items-center h-100 gradient-custom-3" style="position: relative; top: -350px; ">
      <div class="container h-100" >
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6" >
            <div class="card" style="border-radius: 15px; max-height: 700px; overflow-y: scroll;">
              <div class="card-body p-5">
                <h2 style="color: black;" class="text-uppercase text-center mb-5"><b>Registration Form</b></h2>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
        <p style="color: black;">Τα πεδία με <span class="red-asterisk">*</span> είναι υποχρεωτικά παρακαλώ όπως τα συμπληρώσετε.<br> 
                Fields marked with <span class="red-asterisk">*</span> are mandatory, please fill them in.</p>
          <div class="col-md-12">
            <div class="form-floating">
              <p style="color: black;"><label for="firstName"> <span class="red-asterisk">*</span>Όνομα:</label>
                <input class="form-control" id="name" name="name" type="text" placeholder="Όνομα/FirstName" onkeypress="return /[a-zA-Zα-ωΑ-Ω]/i.test(event.key)" required/>
            </div>
          </div>
          <br>
          <!-- <div class="row mb-3"> -->
            <div class="col-md-12">
              <div class="form-floating mb-3 mb-md-3">
                <p style="color: black;"><label for="lastName"> <span class="red-asterisk">*</span>Επίθετο:</label>
                <input class="form-control" id="surname" name="surname" type="text" placeholder="Επίθετο/LastName" onkeypress="return /[a-zA-Zα-ωΑ-Ω]/i.test(event.key)" required/>
              </div>
            </div>
            <br>
          <!-- </div> -->
          <!-- <div class="row mb-3"></div> -->
          <div class="col-md-12">
            <div class="form-floating mb-3 mb-md-3">
                <p style="color: black;" for="workemail"><span class="red-asterisk">*</span>Email:</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="Εmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
            </div>
          </div>
          <br>
          <!-- <div class="row mb-3"></div> -->
          <!-- <div class="row mb-3"></div> -->
            <div class="col-md-12">
              <div class="form-floating mb-3 mb-md-3">
                <p style="color: black;"> <label for="student_department"><span class="red-asterisk">*</span>Πόλη καταγωγής:</label>
                  <br>
                  <select class= "form-control"name="city" required style="max-width: 440px;">
                      <option value="" disabled selected>Επιλέξτε την πόλη σας/Select your city</option>
                          <option value="1">Λάρνακα/Larnaca</option>
                          <option value="1">Πάφος/Paphos</option>
                          <option value="1">Λευκωσία/Nicosia</option>
                          <option value="1">Λεμεσός/Limassol</option>
                  </select>
                  </label>
                </div>
          <br>
            <div class="row mb-3">
              <div class="col-md-12">
                <div class="form-floating mb-3 mb-md-3">
                  <p style="color: black;" for="City"><span class="red-asterisk">*</span>Περιοχή Διαμονής:</label>
                  <input class="form-control" id="area" name="area" type="text" placeholder="Περιοχή" required/>
                </div>
              </div>
            </div>
          <br>
        <div class="row mb-3">
          <div class="col-md-12">
            <div class="form-floating">
              <p style="color: black;" for="Phone_number"><span class="red-asterisk">*</span>Κινητό Τηλέφωνο:</label>
              <input class="form-control" id="phone" name="phone" type="tel" placeholder="Κινητό τηλέφωνο/Phone number" pattern="[0-9]{8}" required/>
            </div>
          </div> 
        </div>            
        <br>
        <div class="row mb-3">
          <div class="col-md-12">
            <div class="form-floating">
              <p style="color: black;" for="username"><span class="red-asterisk">*</span>Όνομα Χρήστη:</label>
              <input class="form-control" id="username" name="username" type="tel" placeholder="Username"required/>
            </div>
          </div>
        </div>
        <br>
        <div class="row mb-3">
          <div class="col-sm-12">
            <label style="color: black;" for="password"><span class="red-asterisk">*</span>Κωδικός Πρόσβασης:</label>
              <input type="password" class="form-control form-control-user"
                  id="password" name="password" placeholder="Password" required minlength="8">
          </div>
        </div>
        <br>
          <div class="row mb-3">
          <div class="col-sm-12">
            <label style="color: black;" for="confirm_password"><span class="red-asterisk">*</span>Επαλήθευση Κωδικόυ:</label>
              <input type="password" class="form-control form-control-user"

                  id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

                  <br><br>  
          <div class="d-flex justify-content-center">
            <button name="submit"type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
              <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
                <style>
                  #form label{float:left; width:140px;}
                  #error_msg{color:red; font-weight:bold;}
                </style>
                    <script>
                       $(document).ready(function(){
                           var $submitBtn = $("button[name='submit']");
                           var $passwordBox = $("#password");
                           var $confirmBox = $("#confirm_password");
                           var $errorMsg =  $('<span id="error_msg">Passwords do not match.</span>');
                    
                           $errorMsg.insertAfter($confirmBox);
                           $errorMsg.hide();
                           
                           $submitBtn.on('click', function(e) {
                               if($confirmBox.val() !== $passwordBox.val() || !$passwordBox.val() || !$confirmBox.val()){
                                   e.preventDefault();
                                   $errorMsg.show();
                               } else {
                                   $errorMsg.hide();
                               }
                           });
                           
                           $("#confirm_password, #password").on("keyup", function(){
                               if($confirmBox.val() === $passwordBox.val()){
                                   $errorMsg.hide();
                               } else {
                                   $errorMsg.show();
                               }
                           });
                       });
                    </script>
                    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
                  </div>
                </form>
                    
                  <p class="text-center text-muted mt-5 mb-0"><b>Already have an account?</b><a href="../php/login.php"
                class="fw-bold text-body"><u>Login here</u></a></p>   
                  </section>     
<!--? Footer Start-->
<div class="footer-area section-bg" data-background="../assets/img/gallery/footer_bg.png" style="background-color: black;">
  <div class="container">
      <div class="footer-top footer-padding">
          <div class="row d-flex justify-content-between">
              <div class="col-xl-3 col-lg-4 col-md-5 col-sm-8">
                  <div class="single-footer-caption mb-50">
                      <!-- logo -->
                      <div class="footer-logo">
                          <a href="../index.html"><img src="../assets/img/logo.png" alt=""></a>
                      </div>
                      <div class="footer-tittle">
                          <div class="footer-pera">
                              <p class="info1">Receive updates and latest news direct from Simply enter.</p>
                          </div>
                      </div>
                      <div class="footer-number">
                          <h4><span>+357 </span>24 044146</h4>
                          <p>michalis@hotmail.com</p>
                      </div>
                  </div>
              </div>
              <div class="col-xl-2 col-lg-2 col-md-3 col-sm-5">
                  <div class="single-footer-caption mb-50">
                      <div class="footer-tittle">
                          <h4>Location </h4>
                          <ul>
                              <li><a href="#">Advanced</a></li>
                              <li><a href="#">Management</a></li>
                              <li><a href="#">Corporate</a></li>
                              <li><a href="#">Customer</a></li>
                              <li><a href="#">Information</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-xl-2 col-lg-2 col-md-3 col-sm-5">
                  <div class="single-footer-caption mb-50">
                      <div class="footer-tittle">
                          <h4>Explore</h4>
                          <ul>
                              <li><a href="#">Cookies</a></li>
                              <li><a href="#">About</a></li>
                              <li><a href="#">Privacy Policy</a></li>
                              <li><a href="#">Proparties</a></li>
                              <li><a href="#">Licenses</a></li>
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 col-sm-8">
                  <div class="single-footer-caption mb-50">
                      <div class="footer-tittle">
                          <h4>Location</h4>
                          <div class="footer-pera">
                              <div class="col-xl-10 col-lg-15 col-md-19 col-sm-10">
                                  <div class="single-footer-caption mb-50">
                                      <div class="footer-tittle">
                                          <ul>
                                              <li><a href="#">Monday 9:00 am- 7:00 pm</a></li>
                                              <li><a href="#">Tuesday 9:00 am - 7:00 pm</a></li>
                                              <li><a href="#">Wednesday 9:00 am - 7:00 pm</a></li>
                                              <li><a href="#">Thursday Closed</a></li>
                                              <li><a href="#">Friday 9:00 am - 7:00 pm</a></li>
                                              <li><a href="#">Suturday 8:00am - 7:00pm</a></li>
                                              <li><a href="#">Sunday Closed</a></li>
                                          </ul>
                                          </div>
                                          </div>

                              <p class="info1">Subscribe now to get daily updates</p>
                          </div>
                      </div>
                      <!-- Form -->
                      <div class="footer-form">
                          <div id="mc_embed_signup">
                              <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part" novalidate="true">
                                  <input type="email" name="EMAIL" id="newsletter-form-email" placeholder=" Email Address " class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email address'">
                                  <div class="form-icon">
                                      <button type="submit" name="submit" id="newsletter-submit" class="email_icon newsletter-submit button-contactForm">Send</button>
                                  </div>
                                  <div class="mt-10 info"></div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="footer-bottom">
          <div class="row d-flex justify-content-between align-items-center">
              <div class="col-xl-9 col-lg-8">
                  <div class="footer-copy-right">
                      <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                  </div>
              </div>
              <div class="col-xl-3 col-lg-4">
                  <!-- Footer Social -->
                  <div class="footer-social f-right">
                      <a href="#"><i class="fab fa-twitter"></i></a>
                      <a href="https://www.facebook.com/sai4ull"><i class="fab fa-facebook-f"></i></a>
                      <a href="#"><i class="fas fa-globe"></i></a>
                      <a href="#"><i class="fab fa-instagram"></i></a>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- Footer End-->
</footer>
<!-- Scroll Up -->
<div id="back-top" >
<a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>

<!-- JS here -->

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

</body>
</html>