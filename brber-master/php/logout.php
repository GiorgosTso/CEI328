<?php
session_start();
include("../php/config.php");
if (isset($_POST['logout_token']) && $_POST['logout_token'] === $_SESSION['logout_token']) {
    // If the logout token is valid, clear and destroy the session
   
    if (isset($_SESSION['email'])) 
    {
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
    }
    $logDateTime = date("Y-m-d H:i:s");
    $logAction = "User: " .$email. " has logged out of the system"; 

    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    $result2 =mysqli_query($conn, $query2);
    
    $_SESSION = array();
    session_destroy();

    // Redirect to login page or home page
    header("location: ../html/index.php");
    exit;
} else {
    // If the logout token is invalid, handle the error or ignore the logout request
    echo "Invalid logout request.";
}
?>