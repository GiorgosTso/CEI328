<?php
include "../php/config.php";

// Check if the request contains the review ID and action
if(isset($_POST['reviewId']) && isset($_POST['action'])) {
    $reviewId = $_POST['reviewId'];
    $action = $_POST['action'];

    // Check if the action is valid (hide or show)
    if($action === 'hide' || $action === 'show') {
        // Update the visibility status of the review in the database
        $sql = "UPDATE reviews SET isHidden = " . ($action === 'hide' ? "1" : "0") . " WHERE reviewID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $reviewId);

        if ($stmt->execute()) {
            // Return a success response
            echo "Review visibility updated successfully!";
        } else {
            // Return an error response
            echo "Error updating review visibility: " . $conn->error;
        }

        // Close statement
        $stmt->close();
    } else {
        // Return an error response if the action is invalid
        echo "Invalid action!";
    }
} else {
    // Return an error response if review ID or action is missing
    echo "Review ID or action missing!";
}

// Close connection
$conn->close();
?>
