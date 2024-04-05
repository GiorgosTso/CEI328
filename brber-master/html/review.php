<!DOCTYPE html>
<html lang="en">
<head>
<?php include "header.php"; ?>
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

<title>Review Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f2f2f2;
    }

    .container {
        max-width: 1100px;
        margin: 160px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-wrap: wrap;
    }

    .review-form {
        flex: 0 0 50%;
        margin-bottom: 50px;
        padding-right: 20px;
    }

    .review-form h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 10px;
    }

    .form-group input[type="text"],
    .form-group select,
    .form-group textarea,
    .form-group input[type="file"] {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        font-size: 16px;
    }

    .form-group textarea {
        height: 120px;
    }

    .form-group button {
        padding: 12px 24px;
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .form-group button:hover {
        background-color: #0056b3;
    }

    .reviews {
        flex: 0 0 50%;
        margin-top: 30px;
        padding-left: 20px;
    }

    .review {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .review h3 {
        margin-top: 10px;
        color: #333;
    }

    .review p {
        color: #666;
        margin-bottom: 5px;
    }

    .stars {
        color: #ffcc00;
        font-size: 24px;
    }

    .stars span {
        cursor: pointer;
        display: inline-block;
        width: 30px;
        height: 30px;
        margin-right: 5px;
        position: relative;
    }

    .stars span:before {
        content: '\2605';
        position: absolute;
        font-size: inherit;
        transition: color 0.3s;
    }

    .stars span:hover:before,
    .stars input[type="radio"]:checked ~ label:before {
        color: #ffcc00;
    }

    .stars input[type="radio"] {
        display: none;
    }

    .stars label {
        display: none;
    }

    .stars input[type="radio"]:checked ~ label {
        display: block;
    }

    .stars input[type="radio"]:checked ~ label:before {
        content: '\2605';
        color: #ffcc00;
    }

    .form-group input[type="file"] {
        cursor: pointer;
    }

    .form-group .file-input-label {
        display: block;
        margin-top: 5px;
    }
</style>
</head>
<body>
<div class="container">
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

<div class="footer-area section-bg" data-background="../assets/img/gallery/footer_bg.png">
            <div class="container">
                <div class="footer-top footer-padding">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-8">
                            <div class="single-footer-caption mb-50">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="../html/index.php"><img src="../assets/img/logo.png" alt=""></a>
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
                                        <li><a href="#"> Management</a></li>
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
                                    <h4>Business Hours</h4>
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
                                                        <li><a href="#">Suturday 8:00 am - 7:00 pm</a></li>
                                                        <li><a href="#">Sunday closed</a></li>
                                                    </ul>
                                                </div>
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

</body>
</html>
