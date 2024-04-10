<?php
session_start();
include "../php/config.php";
// Check if the request is AJAX and a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $time = $_POST['time'] ?? '';

    if (empty($name) || empty($price) || empty($time)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Check if a service with the same name already exists
    $checkQuery = "SELECT name FROM service WHERE name = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    if ($checkResult->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'A service with the same name already exists.']);
        exit;
    }
    $checkStmt->close();

    // Proceed with insertion if the name is unique
    $query = "INSERT INTO service (name, price, time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if (isset($_SESSION['email'])) 
    {
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
    }   
    
    $logDate = date("Y-m-d");
    $logAction = "User: " .$email. " has added a new service ".$name; 

    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDate', '$logAction')";
    $result2 =mysqli_query($conn, $query2);

    if ($stmt) {
        $stmt->bind_param("sss", $name, $price, $time); // Adjusted bind_param to "sss" assuming price can be a string format too, like "19.99"
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'Service added successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add service.']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Query preparation failed.']);
    }
} else {
    // Not a POST request
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
