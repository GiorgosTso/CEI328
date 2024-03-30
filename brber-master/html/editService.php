<?php
// Start the session
session_start();

// Define response structure
$response = ['status' => 'error', 'message' => 'Action failed'];

// Check if the user is logged in and is an admin
if (isset($_SESSION["typeOfUser"]) && $_SESSION["typeOfUser"] == "1") {
    // Include your database connection script
    include "../php/config.php";

    // Retrieve form data
    $serviceId = isset($_POST['serviceId']) ? intval($_POST['serviceId']) : 0;
    $serviceName = isset($_POST['name']) ? trim($_POST['name']) : '';
    $servicePrice = isset($_POST['price']) ? trim($_POST['price']) : '';
    $serviceTime = isset($_POST['time']) ? trim($_POST['time']) : '';

    // Check for existing service name excluding the current serviceId
    $checkQuery = "SELECT serviceId FROM service WHERE name = ? AND serviceId <> ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("si", $serviceName, $serviceId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Another service with the same name already exists.']);
        exit;
    }
    $checkStmt->close();

    // Validate input
    if (!empty($serviceName) && !empty($servicePrice) && !empty($serviceTime)) {
        // Prepare an update statement
        $query = "UPDATE service SET name = ?, price = ?, time = ? WHERE serviceId = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("sssi", $serviceName, $servicePrice, $serviceTime, $serviceId);
            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Service updated successfully'];
            } else {
                $response = ['status' => 'error', 'message' => 'Error updating record: ' . $conn->error];
            }
            $stmt->close();
        } else {
            $response = ['status' => 'error', 'message' => 'Unable to prepare the statement.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Invalid input data provided.'];
    }

    // Close connection
    $conn->close();
} else {
    $response = ['status' => 'error', 'message' => 'Unauthorized access.'];
}

// Return response
echo json_encode($response);
