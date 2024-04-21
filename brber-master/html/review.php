<?php
    ob_start();
    
    //session_start();
    include "header.php";

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
        $name = $_SESSION['name']; // Assuming 'name' is the user's name stored in the session
        $id = $_SESSION['id']; // Assuming 'id' is the user's ID stored in the session
    } else {
        // User is not logged in, handle this case accordingly
        $name = "Guest";
        $id = null; // Set to null or handle it based on your application's logic
    }
?>

<!DOCTYPE html>
<html lang="en">

    
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Reviews</title>
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
    <link rel="stylesheet" href="../assets/css/review.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="review.css">


<title>Review Page</title>

</head>

        
    
    <body>
        <main>
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
        <?php 
        $nameUser = $_SESSION['name']; 
        $surnameUser = $_SESSION['surname'];
    ?>
    </header>




<div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>Review</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="containerr">
    <div class="review-form">
        <h2>Leave a Review</h2>
        <form action="review_process.php" method="post" enctype="multipart/form-data" class="review-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?= $nameUser . " " . $surnameUser?>">
            </div>
            <br>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <div class="rating-options">
                <select id="rating" name="rating" required>
                    <option value="5">&#9733; &#9733; &#9733; &#9733; &#9733; (5 Stars)</option>
                    <option value="4">&#9733; &#9733; &#9733; &#9733; &#9734; (4 Stars)</option>
                    <option value="3">&#9733; &#9733; &#9733; &#9734; &#9734; (3 Stars)</option>
                    <option value="2">&#9733; &#9733; &#9734; &#9734; &#9734; (2 Stars)</option>
                    <option value="1">&#9733; &#9734; &#9734; &#9734; &#9734; (1 Star)</option>
                </select>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label for="comment">Comment:</label>
                <textarea id="comment" name="comment" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo (optional):</label>
                <input type="file" id="photo" name="photo">
                <span class="file-input-label">(Max size: 5MB)</span>
            </div>

           
            <!-- Success message container -->
           <div class="success-message" style="display: none;">
              Your review has been submitted successfully!
          </div>

          <div class="form-group mt-3">
                <button class="btn btn-danger" >Submit Review</button>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>          
    <script>
 $(document).ready(function() {
    $('.review-form form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = new FormData(this); // Create formData object

        // AJAX request to submit the form data
        $.ajax({
            url: $(this).attr('action'), // Form action URL
            type: $(this).attr('method'), // Form method (POST)
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Show success message
                $('.success-message').show().text("Your review has been submitted successfully!");
                

                // Reload the page after 2 seconds
                setTimeout(function() {
                    location.reload();
                }, 4000);
            },
            error: function(xhr, status, error) {
                // Show error message if there's an issue with the AJAX request
                console.error("Error: " + xhr.responseText);
            }
        });
    });
});


</script>


            </div>
        </form>
    </div>

    <div class="old_reviews">
    <p>If you want to see old reviews <a href="https://www.google.com/search?sca_esv=d43f5111e59e559f&sca_upv=1&rlz=1C1ONGR_enCY1068CY1069&sxsrf=ACQVn08UShSEYcPaWsN4i30nYeqeTxp3gw:1713367274816&uds=AMwkrPtyB8MsmozA4Lwzqy2G2HCu0qbm4ObTjsN3lnxmT3sR23xVSdi3ir05P-oOoUmZ1xWaRKBL9H5_hhFJZ_agognjMX7c1OQ8XWodMvk04wgEAUJQZbKp2EpXhGEvAo9tYQHhIP06&si=AKbGX_oXOTjHK3vNPxrwAU4tsC2W_rsdJDrrSHpqUAOdbOh1q-a44v6KQxRsgy_VPxwVo9WXjjVWFDd4DBnvjPaYJu0xYkuJQ0GZy7jAc2ZjGttN-T9qdRWDGluih6ovAFvjbWgJh7V9r6SUPFvlNxrxt_e25XJaVw%3D%3D&q=Southside+barbershop+Reviews&hl=en-CY&sa=X&ved=2ahUKEwjM1KO-xsmFAxUuVKQEHZEZA8AQ_4MLegQIFRAL&biw=1536&bih=695&dpr=1.25"> click here</a>.</p>
</div>
    <div class="reviews">
        <h2>Reviews</h2>
        <?php

include "../php/config.php";

// Fetch reviews from database
$sql = "SELECT reviewID, name, picture, content, numStars, date, isHidden FROM reviews ORDER BY reviewID DESC";
$result = $conn->query($sql);

$logDateTime = date("Y-m-d H:i:s");
$logAction = "User: " .$name. " has left a review";
$query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
$result2 =mysqli_query($conn, $query2);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // For regular users, hide reviews marked as hidden by admin
        if ($typeOfUser != 1 && $row['isHidden'] == 1) {
            continue; // Skip this review for regular users if it's hidden
        }
        // Output review with visibility class and data-is-hidden attribute
        echo '<div class="review" data-review-id="' . $row['reviewID'] . '" data-is-hidden="' . $row['isHidden'] . '">';

        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p class="review-content">' . htmlspecialchars($row['content']) . '</p>';
        $stars = intval($row['numStars']);
        $starIcons = str_repeat('&#9733;', $stars) . str_repeat('&#9734;', 5 - $stars);
        echo '<div class="stars review-content">' . $starIcons . '</div>';
        echo '<p>Date: ' . htmlspecialchars($row['date']) . '</p>';

        if (!empty($row['picture'])) {
            echo '<div style="display:flex; justify-content:end;">';
            echo '<img src="' . htmlspecialchars($row['picture']) . '" alt="Review Photo" style="max-width: 300px; max-height: 400px;">';
            echo '</div>';
        }

        // Show hide/show buttons for admins
        if ($typeOfUser == 1) {
            echo '<button class="toggleReviewButton btn btn-danger" data-action="hide" data-review-id="' . $row['reviewID'] . '">Hide</button>';
            echo '<button class="toggleReviewButton btn btn-success" data-action="show" data-review-id="' . $row['reviewID'] . '">Show</button>';
        }

        echo '</div>';
    }
} else {
    echo "No reviews yet.";
}

$conn->close();
?>




</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to handle hiding and showing reviews
    function toggleReview(reviewId, action) {
        // AJAX request to update the review visibility in the database
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
                if (xhr.status === 200) {
                    // Check if the response indicates success or error
                    if (xhr.responseText === 'success') {
                        // Handle success: Update UI and show success message
                        if (action === 'hide') {
                            // Hide the review from regular users
                            const review = document.querySelector('.review[data-review-id="' + reviewId + '"]');
                            review.classList.add('hidden');
                        } else if (action === 'show') {
                            // Show the review to regular users
                            const review = document.querySelector('.review[data-review-id="' + reviewId + '"]');
                            review.classList.remove('hidden');
                        }
                        // Show success message
                        const successMessage = document.createElement('p');
                        successMessage.textContent = action === 'hide' ? 'Review successfully hidden!' : 'Review successfully shown!';
                        successMessage.classList.add('success-message');
                        button.parentNode.insertBefore(successMessage, button.nextSibling);
                        // Remove success message after 5 seconds
                        setTimeout(function() {
                            successMessage.remove();
                        }, 4000);
                    } else {
                        // Handle error: Display error message to the user
                        alert( xhr.responseText);
                    }
                } else {
                    console.error('Error: ' + xhr.responseText);
                }
            }
        };

        xhr.open('POST', '../html/update_review.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('reviewId=' + reviewId + '&action=' + action);
    }

    // Event listener for toggleReviewButtons
    const toggleReviewButtons = document.querySelectorAll('.toggleReviewButton');
    toggleReviewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const reviewId = this.getAttribute('data-review-id');
            const action = this.getAttribute('data-action');
            toggleReview(reviewId, action);
        });
    });
});

</script>



<?php include "footer.php"?>
        
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
<?php
ob_end_flush(); // Flush the output buffer
?>
