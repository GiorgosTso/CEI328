<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">          
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest">
          
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="login_123.css">
    	<style>
        .selected 
        {
          background-color: green;
          color: white;
        }
        .calendar 
        {
        text-align: center;
        margin-top: 50px;
        /* Hide overflow to remove scroll bar */
        overflow: hidden;
        }

        h2, input, select, button 
        {
          margin-bottom: 20px;
          font-size: 16px;
          padding: 8px;
        }

        button 
                  {
         background-color: #007bff;
          color: white;
         border: none;
          cursor: pointer;
       }

       button:hover 
       {
          background-color: #0056b3;
        }
      </style>
	<link rel="stylesheet" href="../assets/css/styleAppointment.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     </head>
        <body>
        <div id="preloader-active">
                <div class="preloader d-flex align-items-center justify-content-center">
                    <div class="preloader-inner position-relative">
                        <div class="preloader-circle"></div>
                        <div class="logo">
                          <a href="index.html"><img src="../assets/img/logo.png" alt=""></a>
                      </div>
                    </div>
                </div>
            </div>
            
            <?php include "header.php"; ?>
            
            <div class="header-area header-transparent pt-20">
                <div class="main-header header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2 col-md-1">
                                <div class="logo">
                                    <img src="../assets/img/logo.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             
             
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

  <body class="one-screen-page">
    <div class="page">
      <main class="page-content" id="perspective">
        <div class="content-wrapper">
          <div class="page-header page-header-perspective">
            <div class="page-header-left"><a class="brand" href="index.html"><img src="../assets/img/appointment/images/logo-default-dark-200x36.png" alt="" width="200" height="36"/></a></div>
            <div class="page-header-center">
              <div class="step-progress">
                <div class="step-progress-top"><span class="step-progress-number">1</span><span>of</span><span class="step-progress-number">3</span></div>
                <div class="step-progress-bottom">
                  <p class="step-progress-text">STEPs</p>
                </div>
              </div>
            </div>
            <div class="page-header-right">
              <div id="perspective-open-menu" data-custom-toggle=".perspective-menu-toggle" data-custom-toggle-hide-on-blur="true"><span class="perspective-menu-text">Menu</span>
                <button class="perspective-menu-toggle"><span></span></button>
              </div>
            </div>
          </div>
          <div class="custom-progress">
            <div class="custom-progress-body" style="width: 0;"></div>
          </div>
          <div id="wrapper">
          <div class="shell"><a class="link link-primary link-return" href="index.html">Back</a></div>
            <section class="section-xl bg-periglacial-blue one-screen-page-content text-center">
              <div class="shell">
                <h2>CHOOSE a SERVICE</h2>
                <div class="p text-width-medium">
                  <p class="big">On this page you can select a service that you need. Here are presented only the most popular barbering services we provide. If you require a personalized barbering service, please contact us.</p>
                </div>
                
                <div class="range range-50">
                  <div class="cell-xs-6 cell-md-3">
                    <article class="card-service-option"><img class="card-service-option-image" src="../assets/img/appointment/icon-service-1-70x62.png" alt="" width="70" height="62"/>
                      <p class="card-service-option-title">STANDARD HAIRCUTS</p>
                      <div class="card-service-option-panel">
                        <p class="card-service-option-text">One of the most popular services our barbers provide</p>
                          <input type="hidden" name="selectedHaircut" value="Standard Haircut">
                          <button id="choose-service-1" class="btn btn-xs card-service-option-control" type="submit">Choose</button>
                      </div>
                    </article>
                  </div>
                  <div class="cell-xs-6 cell-md-3">
                    <article class="card-service-option"><img class="card-service-option-image" src="../assets/img/appointment/icon-service-2-70x62.png" alt="" width="70" height="62"/>
                      <p class="card-service-option-title">SHAVES</p>
                      <div class="card-service-option-panel">
                        <p class="card-service-option-text">Our shaving services will make you look really handsome</p>
                        <input type="hidden" name="selectedHaircut" value="Shaving">
                        <a id="choose-service-1" class="btn btn-xs card-service-option-control" href="#">Choose</a>
                      </div>
                    </article>
                  </div>
                  <div class="cell-xs-6 cell-md-3">
                    <article class="card-service-option"><img class="card-service-option-image" src="../assets/img/appointment/icon-service-3-70x62.png" alt="" width="70" height="62"/>
                      <p class="card-service-option-title">SKIN FADE</p>
                      <div class="card-service-option-panel">
                        <p class="card-service-option-text">Well-trimmed beard is a must-have element of every men’s image</p>
                        <input type="hidden" name="selectedHaircut" value="Skin Fade">
                        <a id="choose-service-1" class="btn btn-xs card-service-option-control" href="#">Choose</a>
                      </div>
                    </article>
                  </div>
                  <div class="cell-xs-6 cell-md-3">
                    <article class="card-service-option"><img class="card-service-option-image" src="../assets/img/appointment/icon-service-4-70x62.png" alt="" width="70" height="62"/>
                      <p class="card-service-option-title">Mustache trim</p>
                      <div class="card-service-option-panel">
                        <p class="card-service-option-text">Mustaches also need to be trimmed regularly</p>
                        <input type="hidden" name="selectedHaircut" value="Mustache Trim">
                        <a id="choose-service-1" class="btn btn-xs card-service-option-control" href="#">Choose</a>
                      </div>
                    </article>
                  </div>
                </div>
              </div>
            </section>



            <div id="wrapper">
            <section class="section-xs bg-periglacial-blue one-screen-page-content text-center">
              <div class="shell">
                <h2>CHOOSE a BARBER</h2>
                <div class="p text-width-medium">
                  <p class="big">Barbershop offers professional services of certified barbers with years of experience. On this page you can choose a preferred barber in a few clicks.</p>
                </div>
                <div class="range range-lg-center">
                  <div class="cell-lg-10">
                    <div class="range range-sm-center range-md-left range-30">
                      <div class="cell-sm-8 cell-md-6">
                          <div class="thumbnail-option">
                          <div class=""><img src="../assets/img/team1.jpg" alt="" width="170" height="180"/></div>
                          <div class="thumbnail-option-body">
                              <div class="thumbnail-option-title">Michalis</div>
                              <button class="btn btn-xs btn-primary btn-circle choose-barber" onclick="chooseBarber('Michalis')">Choose</button>
                          </div>
                      </div>
                      </div>
                      
            </section>
            <div id="wrapper">
            <section class="section-xs bg-periglacial-blue one-screen-page-content text-center">
              <div class="shell">
                <h2>Choose a Date</h2>
                <div class="p text-width-medium">
                  <p class="big">To complete your booking, please choose the date and time that fit you best. We will be glad to offer you top-notch barber services on the selected day.</p>
                </div>
                <div class="calendar">
                <h2>Select Date and Time for Appointment</h2>
                <input type="date" id="appointmentDate">
                
                <br>
                <button class="btn btn-xs" onclick="scheduleAppointment()">Schedule Appointment</button>
                </div>
              <script src="script.js"></script>
                </div>
              </div>
            </section>
              <!--? Footer Start-->
              <?php include "footer.php"?>
          <!-- Scroll Up -->
          <div id="back-top" >
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
<script>
  let selectedService = null;
  var chooseButtons = document.querySelectorAll('.card-service-option-control');

  chooseButtons.forEach(function(button) {
    button.addEventListener('click', function(event) {
      event.preventDefault();

      chooseButtons.forEach(function(btn) {
        btn.classList.remove('selected');
      });

      button.classList.add('selected');

      selectedService = button.parentNode.parentNode.querySelector('.card-service-option-title').textContent;

      var serviceDescription = button.parentNode.querySelector('.card-service-option-text').textContent;
      console.log("Selected Service: " + selectedService + "\nDescription: " + serviceDescription);
    });
  });

  function sendToDatabase() {
    if (selectedService) {
      console.log("Sending selected service to the database: " + selectedService);
      selectedService = null;
    } else {
      console.log("Please select a service before proceeding.");
    }
  }
</script>

<script>
  function chooseBarber(barberName) 
  {
    let selectedBarber = barberName;

    console.log("Selected Barber: " + selectedBarber);

    sendBarberToDatabase(selectedBarber);
  }

// Function to send selected barber to the database (similar to sendToDatabase function for services)
  function sendBarberToDatabase(selectedBarber) 
  {
    if (selectedBarber) {
        console.log("Sending selected barber to the database: " + selectedBarber);
    } else {
        console.log("Please select a barber before proceeding.");
    }
  }
</script>

<script>
  function scheduleAppointment() {
    var selectedDate = document.getElementById("appointmentDate").value;
    var selectedTime = document.getElementById("appointmentTime").value;

    if (selectedDate && selectedTime) {
        console.log("Appointment scheduled for " + selectedDate + " at " + selectedTime);
        // Here you can add code to send the selected date and time to the database
    } 
    else {
        alert("Please select both date and time for the appointment.");
    }
}
</script>
