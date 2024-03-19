<?php

   $email = $name = $surname = $message = $subjet = "";  

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    if (empty[$_POST["email"]])
    {
        $email_error = "Email is required";
    }
    else
    {
        $email = test_input($_POST["email"]);
        //checking the email format
        if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) 
        {
            $email_error = "Invalid email format"

        }

    }
  

    if (empty[$_POST["name"]])
    {
        $name_error = "Name is required";
    }
    else
    {
        $name = test_input($_POST["name"]);
        //checking if name has only letters
        if(!preg_match("/^[a-zA-Z-' ]*$/", $name))
        {
            $name_error = "Only letters and white space allowed";
        }
    }

    if (empty[$_POST["surname"]])
    {
        $surname_error = "Surname is required";
    }
    else
    {
        $surname = test_input($_POST["surname"]);
        //checking if surname has only letters
        if(!preg_match("/^[a-zA-Z-' ]*$/", $surname))
        {
            $surname_error = "Only letters and white space allowed";
        }
    }


    if (empty[$_POST["message"]])
    {
        $message_error = "Message is required";
    }
    else
    {
        $message = test_input($_POST["message"]);
    }
    
    
    if (empty[$_POST["subject"]])
    {
        $subject_error = "Subject is required";
    }
    else
    {
        $subject = test_input($_POST["subject"]);
    }

    //if there are no errors send the message
    if ($email_error == "" && $name_error == "" && $surname_error == "" && $message_error == "" && $subject_error == "")
    {
        $message = $_POST['message'];
        $name = $_POST['name'];
        $name = $_POST['surname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];

        $to = "rafaant26@gmail.com";
        $body = "";

        $body .= "From: ".$name. "\r\n";
        $body .= "Email: ".$email. "\r\n";
        $body .= "Message: ".$message. "\r\n";

    }
    function test_input($data) 
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
   }
  }
?>