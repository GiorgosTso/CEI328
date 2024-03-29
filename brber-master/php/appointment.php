<?php
session_start();
include("config.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nameOfBarber = $_POST["nameOfBarber"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $serviceId = $_POST["serviceId"];
    $payment = isset($_POST["payment"]) ? 1 : 0; // Assuming it's a checkbox input


    if (empty($nameOfBarber) || empty($date) || empty($time) || empty($serviceId)) {
        echo "Please fill in all fields.";
    } else {
        // Prepare SQL statement to insert data into the appointment table
        $query2 = "INSERT INTO appointment (nameOfBarber, date, time, serviceId, payment) VALUES ('$nameOfBarber', '$date', '$time', '$serviceId', '$payment')";

        $result = mysqli_query($conn, $query2);

        header("Location: ../html/index.php");
        die();
    }
}
?>
