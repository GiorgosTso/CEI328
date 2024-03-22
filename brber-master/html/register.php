<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>register</title>
    <link href="../css/sb-admin-2.css" rel="stylesheet" >
    <link href="../css/register.css" rel="stylesheet">
    <style>
      .red-asterisk {
        color: red;
      }
    </style>
</head>
  <section class="vh-100 bg-image" style="background-image: url('../css/slider.jpg')" >
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
      <div class="container h-100" style="height: 500px; overflow-y: scroll;">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6">
            <div class="card" style="border-radius: 15px;">
              <div class="card-body p-5">
                <h2 style="color: black;" class="text-uppercase text-center mb-5"><b>Registration Form</b></h2>

      <form action="../php/register.php" method="post" enctype="multipart/form-data">
        <p style="color: black;">Τα πεδία με<span class="red-asterisk">*</span>
                είναι υποχρεωτικά παρακαλώ όπως τα συμπληρώσετε/ Fields marked with <span class="red-asterisk">*</span> are mandatory, please fill them in.</p>
          <div class="col-md-6">
            <div class="form-floating">
              <p style="color: black;"><label for="firstName"> <span class="red-asterisk">*</span>Όνομα:</label>
                <input class="form-control" id="name" name="name" type="text" placeholder="Όνομα/FirstName" onkeypress="return /[a-zA-Zα-ωΑ-Ω]/i.test(event.key)" required/>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <div class="form-floating mb-3 mb-md-0">
                <p style="color: black;"><label for="lastName"> <span class="red-asterisk">*</span>Επίθετο:</label>
                <input class="form-control" id="surname" name="surname" type="text" placeholder="Επίθετο/LastName" onkeypress="return /[a-zA-Zα-ωΑ-Ω]/i.test(event.key)" required/>
              </div>
            </div>
          </div>

          <div class="row mb-3"></div>
            <div class="col-md-12">
              <div class="form-floating mb-3 mb-md-3">
                <p style="color: black;"> <label for="student_department"><span class="red-asterisk">*</span>Πόλη καταγωγής:</label>
                  <select class= "form-control"name="city" required style="max-width: 440px;">
                      <option value="" disabled selected>Επιλέξτε την πόλη σας/Select your city</option>
                          <option value="1">Λάρνακα/Larnaca</option>
                          <option value="1">Πάφος/Paphos</option>
                          <option value="1">Λευκωσία/Nicosia</option>
                          <option value="1">Λεμεσός/Limassol</option>
                  </select>
                  </label>
                </div>

          <div class="row mb-3"></div>
            <div class="form-floating">
              <label style="color: black;" for="workemail"><span class="red-asterisk">*</span>Email:</label>
                <input class="form-control" id="email" name="email" type="email" placeholder="Εmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
            </div>
          <div class="row mb-3"></div>

        <div class="row mb-3">
          <div class="col-md-6">
            <div class="form-floating mb-3 mb-md-0">
              <label style="color: black;" for="City"><span class="red-asterisk">*</span>Περιοχή Διαμονής:</label>
            <input class="form-control" id="area" name="City" type="text" placeholder="Γράψε απο πού έρχεσε" required/>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-floating">
            <label style="color: black;" for="Phone_number"><span class="red-asterisk">*</span>Κινητό Τηλέφωνο:</label>
            <input class="form-control" id="phone" name="phone" type="tel" placeholder="Κινητό τηλέφωνο/Phone number" pattern="[0-9]{8}" required/>
          </div>
        </div>             

        <div class="col-md-6">
          <div class="form-floating">
            <label style="color: black;" for="username"><span class="red-asterisk">*</span>Όνομα Χρήστη:</label>
            <input class="form-control" id="username" name="username" type="tel" placeholder="Username"required/>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label style="color: black;" for="password"><span class="red-asterisk">*</span>Κωδικός Πρόσβασης:</label>
              <input type="password" class="form-control form-control-user"
                  id="password" name="password" placeholder="Password" required minlength="8">
          </div>
          <div class="col-sm-6">
            <label style="color: black;" for="confirm_password"><span class="red-asterisk">*</span>Επαλήθευση Κωδικόυ:</label>
              <input type="password" class="form-control form-control-user"

                  id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>

                  
          <div class="d-flex justify-content-center">
            <button name="submit"type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
              <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
                <style>
                  #form label{float:left; width:140px;}
                  #error_msg{color:red; font-weight:bold;}
                </style>
                    <script>
                       $(document).ready(function(){
                           var $submitBtn = $("button[name='submit']");
                           var $passwordBox = $("#password");
                           var $confirmBox = $("#confirm_password");
                           var $errorMsg =  $('<span id="error_msg">Passwords do not match.</span>');
                    
                           $errorMsg.insertAfter($confirmBox);
                           $errorMsg.hide();
                           
                           $submitBtn.on('click', function(e) {
                               if($confirmBox.val() !== $passwordBox.val() || !$passwordBox.val() || !$confirmBox.val()){
                                   e.preventDefault();
                                   $errorMsg.show();
                               } else {
                                   $errorMsg.hide();
                               }
                           });
                           
                           $("#confirm_password, #password").on("keyup", function(){
                               if($confirmBox.val() === $passwordBox.val()){
                                   $errorMsg.hide();
                               } else {
                                   $errorMsg.show();
                               }
                           });
                       });
                    </script>
                    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
                  </div>
                </form>
                    
                  <p class="text-center text-muted mt-5 mb-0"><b>Already have an account?</b><a href="login.html"
                class="fw-bold text-body"><u>Login here</u></a></p>