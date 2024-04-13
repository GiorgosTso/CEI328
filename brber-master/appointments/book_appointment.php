<?php
session_start(); // Always start with this line
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $barberID = $_SESSION['selectedBarberId'];
    $date = $_POST['date'];
    $time_slot_id = $_POST['time_slot_id'];
    $status = "booked";
    $clientID = $_SESSION['id'];
    

    $stmt = $mysqli->prepare("INSERT INTO appointments (date,barberID, time_slot_id, client_id,status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiis", $date,$barberID , $time_slot_id, $clientID,$status);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Appointment booked successfully!']);
    } else {
        echo json_encode(['message' => 'Failed to book appointment.']);
    }
    
}
?>