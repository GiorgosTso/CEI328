

<!DOCTYPE html>
<html lang="en">

    
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
    <link rel="stylesheet" href="../assets/css/review.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="review.css">

<title>Review Page</title>

</head>

        
    
    <body>
    
        <main>


    <header>
        <?php include "header.php";
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
                <button type="submit">Submit Review</button>
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
                // Optionally, you can do other actions like resetting the form, etc.

                // Reload the page after 2 seconds
                setTimeout(function() {
                    location.reload();
                }, 5000);
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
   
    
    <div class="reviews">
        <h2>Reviews</h2>
        <?php
    include "../php/config.php";
   

    // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
        }
    

    

    // Fetch reviews from database and shows only the reviews that are not hidden by the admin
    $sql = "SELECT reviewID, name, picture, content, numStars, date, isHidden FROM reviews WHERE isHidden = 0 ORDER BY reviewID DESC";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $visibilityClass = ($row['isHidden'] && !$typeOfUser) ? 'hidden' : 'visible'; // Determine visibility based on user role
            echo '<div class="review ' . $visibilityClass . '" data-review-id="' . $row['reviewID'] . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="review-content">Content: ' . htmlspecialchars($row['content']) . '</p>';
            $stars = intval($row['numStars']);
            $starIcons = str_repeat('&#9733;', $stars) . str_repeat('&#9734;', 5 - $stars);
            echo '<div class="stars review-content">' . $starIcons . '</div>';
            echo '<p>Date: ' . htmlspecialchars($row['date']) . '</p>';
            
            if (!empty($row['picture'])) {
                echo '<img src="' . htmlspecialchars($row['picture']) . '" alt="Review Photo" style="max-width: 100%; height: auto;">';
            }
            if($typeOfUser==1){
             {
                echo '<button class="toggleReviewButton btn btn-danger" data-action="hide" data-review-id="' . $row['reviewID'] . '">Hide</button>';
            } 
        }
            
            echo '</div>';
        }
    } else {
        echo "No reviews yet.";
    }
    
    // Close connection
    $conn->close();
    ?>




</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleReviewButtons = document.querySelectorAll('.toggleReviewButton');

    toggleReviewButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const reviewId = this.getAttribute('data-review-id');
            const action = this.getAttribute('data-action');

            // AJAX request to update the review visibility in the database
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    console.log(xhr.responseText);
                    if (xhr.status === 200) {
                        // Hide the review
                        const review = document.querySelector('.review[data-review-id="' + reviewId + '"]');
                        review.classList.add('hidden');
                        // Show success message
                        const successMessage = document.createElement('p');
                        successMessage.textContent = 'Review successfully hidden!';
                        successMessage.classList.add('success-message');
                        button.parentNode.insertBefore(successMessage, button.nextSibling);
                        // Remove success message after 5 seconds
                        setTimeout(function() {
                            successMessage.remove();
                        }, 5000);
                    } else {
                        console.error('Error: ' + xhr.responseText);
                    }
                }
            };

            xhr.open('POST', '../html/update_review.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('reviewId=' + reviewId + '&action=' + action);
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
    
    <?php
        ob_end_flush(); 
        ?>
    


</body>
</html>
