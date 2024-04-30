<!DOCTYPE html>
<html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Gallery</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="site.webmanifest" />
    <link
      rel="shortcut icon"
      type="image/x-icon"
      href="../assets/img/favicon.ico"
    />

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="../assets/css/slicknav.css" />
    <link rel="stylesheet" href="../assets/css/flaticon.css" />
    <link rel="stylesheet" href="../assets/css/gijgo.css" />
    <link rel="stylesheet" href="../assets/css/animate.min.css" />
    <link rel="stylesheet" href="../assets/css/animated-headline.css" />
    <link rel="stylesheet" href="../assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="../assets/css/themify-icons.css" />
    <link rel="stylesheet" href="../assets/css/slick.css" />
    <link rel="stylesheet" href="../assets/css/nice-select.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
  </head>
  <body>
    <!-- ? Preloader Start -->
    <div id="preloader-active">
      <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
          <div class="preloader-circle"></div>
          <div class="preloader-img pere-text">
            <img src="../assets/img/logo.png" alt="" />
          </div>
        </div>
      </div>
    </div>
    <!-- Preloader Start -->
    <?php include "header.php";
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true  && $_SESSION['typeOfUser'] == '1'){
      // Display the button for admins
      echo '<a href="indexcode.php"> <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">
          Edit Products
        </button>
        </a>';}
 
    ?>
    <div class="gallery">
        <?php 
        //Fetch image paths from the database
        
        $db = new PDO('sqlite:southside.db'); 
        $stmt = $db->prepare("SELECT image_id, image_path, caption FROM gallery");
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($images as $image) {
            echo '<div class="gallery-item">';
            echo '<img src="' . htmlspecialchars($image['image_path']) . '" alt="Gallery Image">';
            if ($image['caption']) {
                echo '<p class="image-caption">' . htmlspecialchars($image['caption']) . '</p>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <main>
      <!--? Hero Start -->
      <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
          <div class="container">
            <div class="row">
              <div class="col-xl-12">
                <div class="hero-cap hero-cap2 pt-70 text-center">
                  <h2>Gallery</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Hero End -->
      <!--? About Area Start -->
      <!--? Gallery Area Start -->
      <div class="gallery-area section-padding30">
            <div class="container">
            <!-- <div class="row justify-content-left">
                        <input type="submit" class="btn btn-primary" value="Change Pictures" style="margin-top: 40px; width: 280px;">
                    </div> -->
                <!-- Section Tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10">
                        <div class="section-tittle text-center mb-100">
                            <span>our image gallery</span>
                            <h2>some images from our barber shop</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut10.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/barber1.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img" style="background-image: url(../assets/img/barber.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut8.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut13.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut14.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut9.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="box snake mb-30">
                            <div class="gallery-img " style="background-image: url(../assets/img/cut12.jpg);"></div>
                            <div class="overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Gallery Area End -->
    </main>

    <footer>
      <?php include "footer.php" ?>
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
