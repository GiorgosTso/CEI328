<?php
session_start();

if (isset($_POST['logout_token']) && $_POST['logout_token'] === $_SESSION['logout_token']) {
    // If the logout token is valid, clear and destroy the session
    $_SESSION = array();
    session_destroy();

    // Redirect to login page or home page
    header("location: ../php/login.php");
    exit;
} else {
    // If the logout token is invalid, handle the error or ignore the logout request
    echo "Invalid logout request.";
}
?>