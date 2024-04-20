<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Services </title>
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
                    <img src="../assets/img/logo.png">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->
    <header>
        <!--? Header Start -->
        <?php include "header.php" ?>
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
                                <h2>Our Services</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->

        <!--? Services Area Start -->
        <section class="service-area section-padding30">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-7 col-lg-8 col-md-11 col-sm-11">
                        <div class="section-tittle text-center mb-90">
                            <span>Professional Services</span>
                            <h2>Our Best services that we offering to you</h2>
                        </div>
                    </div>
                </div>

                <!--code for add button -->
                <?php if (isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"] == 1) : ?>
                    <button onclick="openAddServiceModal()" class="btn btn-primary">Add Service</button>
                    <br><br> <!-- Two line breaks for more space -->
                <?php endif; ?>


                <!-- Section caption -->
                <div class="row">
                    <?php
                    include "../php/config.php";

                    $sql = "SELECT serviceId, name, price, time FROM service";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-xl-3 col-lg-3 col-md-6">';
                            echo '    <div class="services-caption text-center mb-30">';
                            echo '        <div class="service-icon">';
                            echo '            <i class="flaticon-healthcare-and-medical"></i>';
                            echo '        </div>';
                            echo '        <div class="service-cap">';
                            echo '            <h2>' . $row["name"] . '</h2>';
                            echo '            <p>' . $row["time"] . ' minutes . €' . $row["price"] . '</p>';

                            // Conditionally display Edit and Delete buttons for admins
                            if (isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"] == 1) {
                                // Inside your service listing loop
                                echo "<button onclick='openEditServiceModal(this)' data-service-id='" . $row["serviceId"] . "' data-service-name='" . htmlspecialchars($row["name"], ENT_QUOTES) . "' data-service-price='" . $row["price"] . "' data-service-duration='" . $row["time"] . "' class='btn btn-secondary'>Edit</button>";
                                echo "<button onclick='deleteService(" . $row["serviceId"] . ")' class='btn btn-danger'>Delete</button>";
                            }

                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 services";
                    }
                    $conn->close();
                    ?>
                </div>

            </div>
        </section>
        <!-- Services Area End -->

    </main>
    <footer>
        <!--? Footer Start-->
        <?php include "footer.php" ?>
        <!-- Footer End-->
    </footer>
    <!-- Scroll Up -->
    <div id="back-top">
        <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
    </div>


    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addServiceForm">
                        <div class="form-group">
                            <label for="serviceName">Service Name</label>
                            <input type="text" class="form-control" id="serviceName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="servicePrice">Price</label>
                            <input type="text" class="form-control" id="servicePrice" name="price">
                        </div>
                        <div class="form-group">
                            <label for="serviceDuration">Duration</label>
                            <input type="text" class="form-control" id="serviceDuration" name="time">
                        </div>
                        <!-- Additional fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addService()">Add Service</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" role="dialog" aria-labelledby="editServiceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editServiceModalLabel">Edit Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editServiceForm">
                        <input type="hidden" id="editServiceId" name="serviceId">
                        <div class="form-group">
                            <label for="editServiceName">Service Name</label>
                            <input type="text" class="form-control" id="editServiceName" name="name">
                        </div>
                        <div class="form-group">
                            <label for="editServicePrice">Price</label>
                            <input type="text" class="form-control" id="editServicePrice" name="price">
                        </div>
                        <div class="form-group">
                            <label for="editServiceDuration">Duration</label>
                            <input type="text" class="form-control" id="editServiceDuration" name="time">
                        </div>
                        <!-- Additional fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="editService()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function openAddServiceModal() {
            $('#addServiceModal').modal('show');
        }

        function openEditServiceModal(button) {
            var serviceId = $(button).data('service-id');
            var serviceName = $(button).data('service-name');
            var servicePrice = $(button).data('service-price');
            var serviceDuration = $(button).data('service-duration');

            // Set the form values
            $('#editServiceId').val(serviceId);
            $('#editServiceName').val(serviceName);
            $('#editServicePrice').val(servicePrice);
            $('#editServiceDuration').val(serviceDuration);

            // Show the modal
            $('#editServiceModal').modal('show');
        }


        // Function to delete a service
        function deleteService(serviceId) {
            if (confirm("Are you sure you want to delete this service?")) {
                $.ajax({
                    type: 'POST',
                    url: 'deleteService.php',
                    data: {
                        serviceId: serviceId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload(); // Reload the page to reflect the changes
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('An error occurred while deleting the service. Please try again.');
                    }
                });
            }
        }

        function addService() {
            // Get form data
            var formData = $('#addServiceForm').serialize();

            $.ajax({
                type: 'POST',
                url: 'addService.php', // Ensure this URL is correct
                data: formData,
                dataType: 'json', // Expecting JSON response from the server
                success: function(response) {
                    if (response.status === 'success') {
                        // Success action
                        alert(response.message); // Show success message
                        $('#addServiceModal').modal('hide'); // Hide the modal

                        // Optionally: Refresh the service list or redirect
                        location.reload(); // Reload the page to see the changes
                    } else {
                        // Error action
                        alert(response.message); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    // AJAX error action
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred while adding the service. Please try again.');
                }
            });
        }


        function editService() {
            var formData = $('#editServiceForm').serialize(); // Get form data

            $.ajax({
                type: 'POST',
                url: 'editService.php', // Ensure this is the correct path to your PHP script
                data: formData,
                success: function(response) {
                    var result = JSON.parse(response);
                    alert(result.message); // Display success or error message
                    if (result.status === 'success') {
                        $('#editServiceModal').modal('hide');
                        location.reload(); // Reload to see changes only if successful
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error); // Handle any AJAX errors
                }
            });

            return false; // Prevent default form submission
        }
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