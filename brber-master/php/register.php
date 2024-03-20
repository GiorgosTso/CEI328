<?php

session_start();
include("config.php");


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $area = $_POST['area'];
    $phone = $_POST['phone'];
    $username = $_POST['username'];
    //$typeOfUser = $_POST['typeOfUser'];
    $password = $_POST['password'];
    
    $hash = password_hash ($password, PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password))
    {
       
        //save to database
        //$query = "insert into clients (name,surname,city,email,area,phone) 
        //values ('$name','$surname','$city','$email','$area','$phone')";

        $query1 = "insert into useraccount(username, password, typeOfUser)values ('$username', '$hash', '3')";

        //$result = mysqli_query($conn, $query);

        $result1 = mysqli_query($conn, $query1);
        
        header("Location: ../php/login.php?Success=Account created successfully");

        die();
    }else
    {
        echo "Please enter some valid information!";
    }
}