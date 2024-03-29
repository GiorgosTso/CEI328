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
    <link rel="stylesheet" href="review.css">
    <!-- CSS here -->
    
</head>

<body>
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
        <?php include "../html/header.php"?>
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
                                <h2>Reviews</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<title>Review Page</title>

    
     


<div class="container1">
    <div class="review-form">
        <h2>Leave a Review</h2>
        <form action="review_process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733; (5 Stars)</option>
                    <option value="4">&#9733; &#9733; &#9733; &#9733; &#9734; (4 Stars)</option>
                    <option value="3">&#9733; &#9733; &#9733; &#9734; &#9734; (3 Stars)</option>
                    <option value="2">&#9733; &#9733; &#9734; &#9734; &#9734; (2 Stars)</option>
                    <option value="1">&#9733; &#9734; &#9734; &#9734; &#9734; (1 Star)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo (optional):</label>
                <input type="file" id="photo" name="photo" accept="image/*">
                <span class="file-input-label">(Max size: 5MB)</span>
            </div>
            <div class="form-group">
                <button type="submit">Submit Review</button>
            </div>
        </form>
    </div>

    <div class="reviews">
        <h2>Reviews</h2>
        <?php include 'display.php'; ?>
    </div>
</div>


<div class="kati">
    <?php include "../html/footer.php"?>
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
