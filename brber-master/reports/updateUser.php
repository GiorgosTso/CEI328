<?php
include "../php/config.php";

$name = mysqli_real_escape_string($conn, $_POST['name']);
$surname = mysqli_real_escape_string($conn, $_POST['surname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$typeOfUser = mysqli_real_escape_string($conn, $_POST['typeOfUser']);
$employeeId = mysqli_real_escape_string($conn, $_POST['employee']);

$query = "UPDATE clients SET name = '$name', surname = '$surname', email = '$email', phone = '$phone' WHERE id = '$employeeId'";

$result = mysqli_query($conn, $query);

if ($result) 
{
    echo "User updated successfully!";
} 
else 
{
    echo "Error updating user: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
<?php

session_start();
include "../php/config.php";
if ($_POST['typeOfUser'] == 2) {
    $employeeId = $_POST['employee'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insertQuery = "INSERT INTO employee (id, name, surname, email, phone) 
                    VALUES ('$employeeId', '$name', '$surname', '$email', '$phone')";
    $insertResult = mysqli_query($conn, $insertQuery);

    $updateQuery = "UPDATE useraccount SET typeOfUser = 2 WHERE id = '$employeeId'";
            $updateResult = mysqli_query($conn, $updateQuery);

    if (!$insertResult) {
        echo "Error: " . mysqli_error($conn);
    } else {
        $deleteQuery = "DELETE FROM clients WHERE id = '$employeeId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            echo "Error: " . mysqli_error($conn);
        } else {
            header("Location: ../reports/management.php?Success=Account updated successfully");
        }
    }
}
?>
<?php
session_start();
include "../php/config.php"; 

if ($_POST['typeOfUser'] == 1) {
    $adminId = $_POST['employee'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insertQuery = "INSERT INTO admin (id, name, surname, email, phone) 
                    VALUES ('$adminId', '$name', '$surname', '$email', '$phone')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if (!$insertResult) {
        echo "Error: " . mysqli_error($conn);
    } else {
        $deleteQuery = "DELETE FROM clients WHERE id = '$adminId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            echo "Error: " . mysqli_error($conn);
        } else {
            $updateQuery = "UPDATE useraccount SET typeOfUser = 1 WHERE id = '$adminId'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Error: " . mysqli_error($conn);
            } else {
                header("Location: ../reports/management.php?Success=Account updated successfully");
            }
        }
    }
}
?>
<?php
session_start();
include "../php/config.php";

if ($_POST['typeOfUser'] == 3) {
    $clientId = $_POST['employee'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $insertQuery = "INSERT INTO clients (id, name, surname, email, phone) 
                    VALUES ('$clientId', '$name', '$surname', '$email', '$phone')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if (!$insertResult) {
        echo "Error: " . mysqli_error($conn);
    } else {
        $deleteQuery = "DELETE FROM employee WHERE id = '$clientId'";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if (!$deleteResult) {
            echo "Error: " . mysqli_error($conn);
        } else {
            $updateQuery = "UPDATE useraccount SET typeOfUser = 3 WHERE id = '$clientId'";
            $updateResult = mysqli_query($conn, $updateQuery);

            if (!$updateResult) {
                echo "Error: " . mysqli_error($conn);
            } else {
                header("Location: ../reports/management.php?Success=Account updated successfully");
            }
        }
    }
}
?>

