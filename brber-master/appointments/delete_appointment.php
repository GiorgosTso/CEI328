<?php
include("../php/config.php");

// Check if appointmentID is provided
if(isset($_GET['remove'])) {
    $id = $_GET['remove'];    
    // Prepare and execute deletion query
    $deleteQuery = "DELETE FROM appointments WHERE id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param('i', $id); // Use $id instead of $appointmentID
    
    if ($stmt->execute()) {
        // Deletion successful
        echo "success";
        header('location:myAppointments.php');
    } else {
        // Deletion failed
        echo "error";
    }
} else {
    // If appointmentID is not provided
    echo "error";
}
?>
