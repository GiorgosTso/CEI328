<?php

session_start();
include("connection.php");

$name = $_POST['name'];
$surname = $_POST['surname'];
$city = $_POST['city'];
$email = $_POST['email'];
$area = $_POST['area'];
$phone = $_POST['phone'];
$username = $_POST['username'];
$typeOfUser = $_POST['typeOfUser'];

$hash = password_hash ($password, PASSWORD_DEFAULT);


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(!empty($email) && !empty($password))
    {
       
        //save to database
        $query = "insert into clients (name,surname,city,email,area,phone,username) 
        values ('$name','$surname','$city','$email','area','$phone')";

        $query1 = "insert into useraccount(username, password, typeOfUser)values ('$username', '$hash', '3')";

        $result = mysqli_query($connection, $query);

        $result1 = mysqli_query($connection, $query1);
        
        header("Location: ../html/login.php?Success=Account created successfully");
        die();
    }else
    {
        echo "Please enter some valid information!";
    }
}