<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $time_slot_id = $_POST['time_slot_id'];
    $client_id = '2';
    //$client_id = $_POST['client_name'];
    $status = "booked";

    $stmt = $mysqli->prepare("INSERT INTO appointments (date, time_slot_id, client_id,status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siis", $date, $time_slot_id, $client_id,$status);
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Appointment booked successfully!']);
    } else {
        echo json_encode(['message' => 'Failed to book appointment.']);
    }
}
?>