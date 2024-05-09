<?php 
	include "../php/config.php";
	
	
	if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
		$target_dir = "../assets/img/gallery/"; // Change this to the desired directory for uploaded files
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
		$id = $_POST['number'];

		// Check if the file is allowed (you can modify this to allow specific file types)
		$allowed_types = array("jpg", "jpeg", "png", "pdf");
		if (!in_array($file_type, $allowed_types)) {
			echo "Sorry, only JPG, JPEG, PNG and PDF files are allowed.";
		} else {
			// Move the uploaded file to the specified directory
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				// File upload success, now store information in the database
				$filename = $_FILES["fileToUpload"]["name"];
				$sql = "UPDATE gallery SET image = ? WHERE id = ?";
				$stmt = $conn->prepare($sql);
				$stmt-> bind_param("si", $target_file,$id);
				$stmt->execute();
				$result = $stmt->get_result();
			}
		}
	}
?>


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
        
    ?>
    <div class="gallery">
      
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
                <!-- Section Tittle -->
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-9 col-sm-10">
                        <div class="section-tittle text-center mb-100">
                            <span>our image gallery</span>
                            <h2>some images from our barber shop</h2>
                            <?php 
                        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true  && $_SESSION['typeOfUser'] == '1'){
                        // Display the button for admin
                        echo'<button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#exampleModal" style="margin-top: 80px;">
                                Edit Images
							</button>';} 
                        ?>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">Add Image</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        <!-- Form to upload image -->
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
				          <div class="form-group">
				            <label for="imageUpload" class="mb-2">Select image to upload:</label>
				            <div class="custom-file">
				              <input type="file" class="custom-file-input" id="imageUpload" name="fileToUpload" required>
				              <label class="custom-file-label" for="imageUpload">Choose file...</label>
				            </div>
				          </div>
				
				          <!-- Dropdown to select number -->
				          <div class="form-group">
				            <label for="numberSelect" class="mb-2">Choose the number of the image:</label>
				            <select class="form-control" id="numberSelect" name="number">
				              <?php for ($i = 1; $i <= 8; $i++): ?>
				                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				              <?php endfor; ?>
				            </select>
				          </div>

				          <div class="modal-footer">
				            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				            <button type="submit" class="btn btn-primary">Upload Image</button>
				          </div>
				        </form>
				    </div>
				</div>
			</div>
		</div>
            <?php    
		$sql = "SELECT * FROM gallery";
$select_stmt = $conn->prepare($sql);
if ($select_stmt === false) {
    echo "Error preparing the statement: " . $conn->error;
} else {
    // Execute the statement
    if ($select_stmt->execute()) {
        $result = $select_stmt->get_result();

        // Organize images by their ID for easy reference
        $images = [];
        while ($row = $result->fetch_assoc()) {
            $images[$row['id']] = $row['image'];
        }
    } else {
        echo "Error executing the statement: " . $select_stmt->error;
    }
    $select_stmt->close();
}

// Define the path to the gallery images and the default image
$target_dir = "../assets/img/gallery/";
$default_image = '../assets/img/logo.png';
?>

<div class="row">
    <!-- Image for ID 1 -->
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[1]) ? htmlspecialchars($images[1]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 2 -->
    <div class="col-lg-8 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[2]) ? htmlspecialchars($images[2]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 3 -->
    <div class="col-lg-8 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[3]) ? htmlspecialchars($images[3]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 4 -->
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[4]) ? htmlspecialchars($images[4]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 5 -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[5]) ? htmlspecialchars($images[5]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 6 -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[6]) ? htmlspecialchars($images[6]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 7 -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[7]) ? htmlspecialchars($images[7]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>

    <!-- Image for ID 8 -->
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[8]) ? htmlspecialchars($images[8]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[9]) ? htmlspecialchars($images[8]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[10]) ? htmlspecialchars($images[8]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[11]) ? htmlspecialchars($images[8]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="box snake mb-30">
            <div class="gallery-img" style="background-image: url('<?php echo isset($images[12]) ? htmlspecialchars($images[8]) : $default_image; ?>');"></div>
            <div class="overlay"></div>
        </div>
    </div>
    
</div>
    </main>

    <footer>
      <?php include "footer.php" ?>
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
      <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>
	<script>
// Script to update the label of the custom file input
$(document).ready(function () {
  $('.custom-file-input').on('change', function() { 
     let fileName = $(this).val().split('\\').pop(); 
     $(this).next('.custom-file-label').addClass("selected").html(fileName);
  });
});
</script>
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
