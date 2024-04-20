<?php
// Include database configuration
include "../php/config.php";

// Check if the request contains the review ID and action
if(isset($_POST['reviewId'], $_POST['action'])) {
    // Sanitize inputs to prevent SQL injection
    $reviewId = intval($_POST['reviewId']);
    $action = $_POST['action'];

    // Check if the action is valid (hide or show)
    if($action === 'hide' || $action === 'show') {
        // Update the visibility status of the review in the database
        $sql = "UPDATE reviews SET isHidden = ? WHERE reviewID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $hiddenValue, $reviewId);

        // Determine the value to set for isHidden based on the action
        $hiddenValue = ($action === 'hide') ? 1 : 0;

        if ($stmt->execute()) {
            // Return a success response
            echo "Review visibility updated successfully!";
        } else {
            // Return an error response
            echo "Error updating review visibility: " . $stmt->error;
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

