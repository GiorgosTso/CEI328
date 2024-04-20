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
    <title> Reviews </title>
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

<style>
    /* Style for the success message container */
    .success-message 
    {
        display: none; /* Initially hidden */
        max-width: 400px;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #4CAF50; /* Green background color */
        color: white;
        border-radius: 6px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    
        .review-form 
        {
            max-width: 1000px;
            margin: 40px auto 20px;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .review-form h2 
        {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .review-form form 
        {
            display: flex;
            flex-direction: column;
        }
        
        .review-form .form-group 
        {
            margin-bottom: 15px;
        }
        
        .review-form label 
        {
            font-weight: bold;
        }
        
        .review-form input[type="text"],
        .review-form select,
        .review-form textarea 
        {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        
        .review-form textarea 
        {
            height: 100px;
        }
    
        .rating-options  
        {
            margin-top: 10px;
        }
    
        .rating-options label 
        {
            display: block;
        }
    
        
        .review-form button[type="submit"] 
        {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .review-form button[type="submit"]:hover 
        {
            background-color: #45a049;
        }
        
        /*  for the container displaying reviews */
        .reviews {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Add scrollbar for overflow */
            max-height: 300px; /* Set max height for scrollbar */
        }
        
        .reviews h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .review {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        .review p {
            margin: 0;
        }

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
<title>Review Page</title>
</head>
    <body>
        <main>
    <header>
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
        <form action="review_process.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
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
                <input type="file" id="photo" name="photo" accept="image/*">
                <span class="file-input-label">(Max size: 5MB)</span>
            </div>
            <!-- Success message container -->
           <div class="success-message" style="display: none;">
              Your review has been submitted successfully!
          </div>

          <div class="form-group mt-3">
                <button type="submit">Submit Review</button>
                
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
                   // Append the newly submitted review to the reviews section
                   $('.reviews').append(response);
                   // Clear the form fields after submission
                   $('.review-form form')[0].reset();
                   // Show success message
                   $('.success-message').fadeIn().delay(2000).fadeOut();
                   // Refresh the page after 2 seconds
                   setTimeout(function() {
                    location.reload();
                   }, 2000);
                                },
                                error: function(xhr, status, error) {
                                    // Handle errors if any
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
    
    // Fetch reviews from database
    $sql = "SELECT reviewID, name, picture, content, numStars, date FROM reviews ORDER BY date DESC";
    $result = $conn->query($sql);

    $logDateTime = date("Y-m-d H:i:s");
    $logAction = "User: " .$name. " has left a review";
    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    $result2 =mysqli_query($conn, $query2);
   // Display reviews
    if ($result->num_rows > 0) 
    {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="review">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p>Content: ' . htmlspecialchars($row['content']) . '</p>';
        echo '<div>Stars: ' . htmlspecialchars($row['numStars']) . '</div>';
        echo '<p>Date: ' . htmlspecialchars($row['date']) . '</p>';
        if (!empty($row['picture'])) {
            echo '<img src="uploads/' . htmlspecialchars($row['picture']) . '" alt="Review Photo" style="max-width: 100%; height: auto;">';
        }
        echo '</div>';
    }
 
} 
else {
    echo "No reviews yet.";
}

// Close connection
$conn->close();
?>


    </div>
    <!-- Success modal -->
    <?php if (!empty($successMessage)): ?>
        <div id="successModal" class="modal" style="display: block;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $successMessage; ?></p>
            </div>
        </div>
    <?php endif; ?>

</main>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById("successModal");
        var closeButton = document.getElementsByClassName("close")[0];

        closeButton.addEventListener("click", function() {
            modal.style.display = "none";
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript code for modal close button -->
<script>
    $(document).ready(function() {
        // Show the success modal when the document is ready
        $('#successModal').show();

        // Close the modal when the close button is clicked
        $('.close').click(function() {
            $('#successModal').hide();
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