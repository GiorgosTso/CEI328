<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">          
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest"> 
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Barber HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
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
    <link rel="stylesheet" href="style1.css">
    
</head>
<body>
<style>
    .row{
        display: flex; /* This defines a flex container */
        /* justify-content: space-between; */
    }
</style>
<!-- ? Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/logo.png">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <?php include "../html/header.php" ?>
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
                                <h2>Appointment</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <?php if (isset($_GET['error'])): ?>
            <div id="errorMessage" style="color: red; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background: #f0f0f0; padding: 10px; border-radius: 5px; border: 1px solid red;">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
            <script>
        setTimeout(function() {
            var messageArea = document.getElementById('errorMessage');
            if (messageArea) {
                messageArea.style.display = 'none';
            }
        }, 3000);
    </script>
        <?php endif; ?>
        <?php if (isset($_GET['message'])): ?>
        
            <div id="messageArea" style="color: green; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background: #f0f0f0; padding: 10px; border-radius: 5px; border: 1px solid green; display:block;">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>
    <script>
        setTimeout(function() {
            var messageArea = document.getElementById('messageArea');
            if (messageArea) {
                messageArea.style.display = 'none';
            }
        }, 3000);
    </script>
<?php endif; ?>
        <section class="service-area section-padding30" style="padding-top: 50px;">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle text-center mb-90"style="margin-bottom: 40px;">
                            <span>Professional Services</span>
                            <h2>Our Best services that we offering to you</h2>
                        </div>
                    </div>
                </div>
                <!-- Section caption -->
                <form action="processSelection.php" method="post">
                    <!-- Services Section -->
                    <div class="row">
                        <?php include "showServices.php"?>
                    </div>
                    
                    <!-- Barbers Section -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-7 col-lg-8 col-md-11 col-sm-11">
                            <div class="section-tittle text-center mb-90"style="margin-bottom: 40px;">
                                <span>Professional Barbers</span>
                                <h2>Choose your barber</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php include "showBarbers.php"?>
                    </div>
                    <input type="hidden" id="selectedServiceId" name="selectedServiceId" value="">
                    <input type="hidden" id="selectedBarberId" name="selectedBarberId" value="">
            
                    <!-- Submission Button -->
                    <div class="row justify-content-center">
                        <input type="submit" class="btn btn-primary" value="Book your Appointment" style="margin-top: 40px; width: 280px;">
                    </div>
                </form>
    <script>
        function selectService(serviceId) {
            document.getElementById('selectedServiceId').value = serviceId;
        }

        function selectBarber(barberId) {
            document.getElementById('selectedBarberId').value = barberId;
        }
    </script>
            </div>
        </section>
        
<!-- ______________________________________________________________________ -->


<?php include "../html/footer.php"?>
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
    <script src="../assets/js/main.js"></script>

</body>

</html>