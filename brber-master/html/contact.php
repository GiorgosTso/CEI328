<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require __DIR__ . '/../php/PHPMailer/src/Exception.php';
require __DIR__ . '/../php/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../php/PHPMailer/src/SMTP.php';


// Initialize PHPMailer
$mail = new PHPMailer(true);


include "../php/config.php";

$successMessage = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $successMessage = 'Your message has been sent successfully! Thank you for contacting us. ';
    // Save message to database
    $sql = "INSERT INTO contacts (name, surname, email, message) VALUES ('$name', '$surname', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'rafaant26@gmail.com'; // SMTP username
            $mail->Password = 'paab twrv dlum zwng'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom($email,$name);
            $mail->addAddress("rafaant26@gmail.com"); 
            $mail->addReplyTo($email,$name);

            // Content
            $mail->isHTML(false); 
            $mail->Subject = 'New Contact Message';
            $mail->Body    = "Name: $name\nSurname: $surname\nEmail: $email\nMessage: $message";

            $mail->send();
             
        } catch (Exception $e) {
            $errorMessage = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
            }
    //Close database connection
    $conn->close();
    ?>



<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Contact </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

   <!-- CSS here -->
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

    <style>
        .error {color: #FF0000}
        .error {font-size: 14px}
        
    .modal{
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 30px;
    border: none;
    width: 60%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); 
    text-align: center;
    color: green; 
    font-size: 18px;
}

.modal-content p {
    color: green; 
    font-size: 18px;
}


.close  {
    color: #aaa;
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
}



    </style>
</head>
<body>


    <!--? Preloader Start -->
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
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <?php include "header.php"?>
        <!-- Header End -->
    </header>
    <main>
    
        <!--? Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>Contact Us</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!--?  Contact Area start  -->
        <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <iframe 
                       src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3269.0797985084737!2d33.697024975218476!3d34.97966586819462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14de29a03d99ad71%3A0x97abd9936b3358ce!2sSouthside%20barbershop!5e0!3m2!1sen!2s!4v1710163766216!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>


                    <script>
                        function initMap() {
                            var uluru = {
                                lat: -25.363,
                                lng: 131.044
                            };
                            var grayStyles = [{
                                    featureType: "all",
                                    stylers: [{
                                            saturation: -90
                                        },
                                        {
                                            lightness: 50
                                        }
                                    ]
                                },
                                {
                                    elementType: 'labels.text.fill',
                                    stylers: [{
                                        color: '#ccdee9'
                                    }]
                                }
                            ];
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {
                                    lat: -31.197,
                                    lng: 150.744
                                },
                                zoom: 9,
                                styles: grayStyles,
                                scrollwheel: false
                            });
                        }
                  
                    </script>
    
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Get in Touch</h2>
                        <span class="error">* Required fields
                    </div>
                    <div class="col-lg-8">
                        <form action="" method="POST" >
                        
                            <div class="row">
                            <div class="col-12">
                                    <div class="form-group">
                                        <br>
                                        <input class="form-control" name="subject" id="subject" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'" placeholder="Enter Subject" style="font-size: 14px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <span class="error">* 
                                        <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'" placeholder=" Enter Message" required style="font-size: 14px;"></textarea>
                                         
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <span class="error">* 
                                        <input class="form-control valid" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" required style="font-size: 14px;">
                                        
                                    </div>
                                </div>
                                <div class=" col-sm-6">
                                    <div class="form-group">
                                    <span class="error">* 
                                        <input class="form-control  valid" name="surname" id="surname" type="surname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your surname'" placeholder="Enter your surname" required style="font-size: 14px;">
                                        
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <span class="error">* 
                                        <input class="form-control  valid" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" required style="font-size: 14px;">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" href="../html/index.php" class="button button-contactForm boxed-btn" value="Send"></input>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Pyla, Larnaca.</h3>
                                <p>Shop 4, Ανθούσης 3, Larnaca 7081</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+357 24 044146</h3>
                                <p>Monday-Wednesday, Friday 9:00 am - 7:00 pm
                                   Thursday,Sunday Closed
                                   Suturday 8:00 am - 7:00 
                    </p>
                                
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>michalis@hotmail.com</h3>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Area End -->
    </main>
    <footer>
        <!--? Footer Start-->
        <?php include "footer.php"?>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top" >
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>

    <!-- JS here -->

    <?php if (!empty($successMessage)): ?>
        <div id="successModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $successMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

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
    
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
        // JavaScript code for modal close button
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById("successModal");
            var closeButton = document.getElementsByClassName("close")[0];

            closeButton.addEventListener("click", function() {
                modal.style.display = "none";
            });
        });
    </script>




    </body>
</html>