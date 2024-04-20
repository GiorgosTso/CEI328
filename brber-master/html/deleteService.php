<?php
session_start();

include "../php/config.php";

$response = ['status' => 'error', 'message' => 'Service could not be deleted'];

if (isset($_SESSION['typeOfUser']) && $_SESSION['typeOfUser'] == 1 && isset($_POST['serviceId'])) {
    $serviceId = $_POST['serviceId'];

    // SQL to delete a record
    $sql = "DELETE FROM service WHERE serviceId = ?";

    if (isset($_SESSION['email'])) 
    {
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
    }

    $logDateTime = date("Y-m-d H:i:s");
    $logAction = "User: " .$email. " has delete a service "; 

    $query2 = "INSERT INTO `log` (`id`, `date`, `action`) VALUES ('$id', '$logDateTime', '$logAction')";
    $result2 =mysqli_query($conn, $query2);

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $serviceId);

        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Service deleted successfully'];
        } else {
            $response['message'] = 'Error executing delete operation';
        }

        $stmt->close();
    }
    $conn->close();
} else {
    $response['message'] = 'Unauthorized request';
}

echo json_encode($response);
