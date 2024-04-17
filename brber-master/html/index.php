<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
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
</head>

<body>
    <!-- ? Preloader Start -->
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
    <?php include "header.php"; ?>

    <main>
        <!--? slider Area Start-->
        <div class="slider-area position-relative fix">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider slider-height d-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-10 col-lg-9 col-md-11 col-sm-10">
                                <div class="hero__caption">
                                    <span data-animation="fadeInUp" data-delay="0.5s">with Mike</span>
                                    <h1 data-animation="fadeInUp" data-delay="0.5s">Make your hair look classy</h1>
                                    <h1 data-animation="fadeInUp" data-delay="0.5s">Make your beard look elegant</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- stroke Text -->
            <div class="stock-text">
                <h2>Get More confident</h2>
                <h2>Get More confident</h2>
            </div>
        </div>
        <!-- slider Area End-->
        <!--? Team Start -->
        <div class="team-area pb-180">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle text-center mb-100">
                            <br><br><br>
                            <h2>Our hair cut experts for you</h2>
                        </div>
                    </div>
                </div>
                <div class="row team-active dot-style">
                    <!-- single Tem -->
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-80 text-center"></div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-80 text-center">
                            <div class="team-img">
                                <img src="../assets/img/team1.jpg" alt="" />
                            </div>
                            <div class="team-caption">
                                <span>Barber</span>
                                <h3><a href="#">Mike</a></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-">
                        <div class="single-team mb-80 text-center"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Team End -->
        <?php
        include "../php/config.php";
        $sql = "SELECT name, price FROM service ORDER BY serviceId ASC";
        $result = $conn->query($sql);

        $services = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

        // Determine how many services should be in each column
        $servicesPerColumn = 6;
        $totalServices = count($services);
        $totalColumns = ceil($totalServices / $servicesPerColumn);
        ?>

        <!-- Pricing Section -->
        <div class="best-pricing section-padding2 position-relative">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-7 col-lg-7">
                        <!-- Section Title -->
                        <div class="section-tittle mb-50">
                            <span>Our Best Pricing</span>
                            <h2>We provide best price<br> in the city!</h2>
                        </div>
                        <!-- Pricing -->
                        <div class="row">
                            <?php for ($col = 0; $col < $totalColumns; $col++) : ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="pricing-list">
                                        <table style="width: 100%;">
                                            <?php
                                            $startIdx = $col * $servicesPerColumn;
                                            $endIdx = min(($col + 1) * $servicesPerColumn, $totalServices);
                                            for ($i = $startIdx; $i < $endIdx; $i++) :
                                                $service = $services[$i];
                                            ?>
                                                <tr>
                                                    <td style="text-align: left;"><?= $service['name']; ?></td>
                                                    <td style="text-align: right;">€<?= $service['price']; ?></td>
                                                </tr>
                                            <?php endfor; ?>
                                        </table>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pricing Image -->
            <div class="pricing-img">
                <img class="pricing-img1" src="../assets/img/cut3.jpg" alt="">
                <img class="pricing-img2" src="../assets/img/gallery/pricing2.png" alt="">
            </div>
        </div>
        <!-- End of Pricing Section -->

        <!--? Gallery Area Start -->
        <div class="gallery-area section-padding30">
            <div class="container">
                
            </div>
        </div>
        <!-- Gallery Area End -->
    </main>
    <footer>
        <!--? Footer Start-->
        <?php include "../html/footer.php" ?>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
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
    <script src="../assets/js/main.js"></script>

</body>

</html>