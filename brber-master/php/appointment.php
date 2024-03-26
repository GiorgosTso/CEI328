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
    }else 
    {
        // Prepare SQL statement to insert data into the appointment table
        $sql = "INSERT INTO appointment (nameOfBarber, date, time, serviceId, payment) VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind parameters to avoid SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssii", $nameOfBarber, $date, $time, $serviceId, $payment);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Appointment scheduled successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }
}
