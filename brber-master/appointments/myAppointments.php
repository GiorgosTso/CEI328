<?php
$loggedInUserID = isset($_SESSION['id']) ? $_SESSION['id'] : null;

include("../php/config.php"); 

// Select appointments for the logged-in user
$query = "SELECT * FROM appointments WHERE id = '$loggedInUserID'";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Barber HTML-5 Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="style1.css">

</head>
    <header>
        <!--? Header Start -->
        <?php include "../html/header.php" ?>
        <!-- Header End -->
    </header>
    <main>
    <?php
        $loggedInUserID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
        $query = "SELECT id FROM useraccount WHERE id = '$loggedInUserID'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $loggedInUserID = $row['id'];
    ?>
        <!--? Hero Start -->
        <div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>My Appointments</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <body>
        <div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Barber</th>
                <th scope="col">Ongoing</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['time_slot_id'] . "</td>";
                echo "<td>" . $row['barberID'] . "</td>";
                // You can add more columns if needed
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
        