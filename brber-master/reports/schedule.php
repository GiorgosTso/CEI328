<?php
include "../php/config.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$typeOfUser = isset($_SESSION['typeOfUser']) ? $_SESSION['typeOfUser'] : null; 

if(isset($_SESSION['id'])) {
    $loggedInUserID = $_SESSION['id'];
} else {
    $loggedInUserID = null;
}

$query = "SELECT appointments.*, time_slots.start_time
          FROM appointments
          JOIN time_slots ON appointments.time_slot_id = time_slots.id
          LEFT JOIN clients ON appointments.client_id = clients.ClientID
          WHERE appointments.barberID = $loggedInUserID";

$result = mysqli_query($conn, $query);
if (!$result) {
    exit;
}
$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Schedule</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3">Southise Barbershop</a>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="chart_day.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="../html/index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Back to the website
                            </a>
                            
                            <?php
                                if ($typeOfUser == 1) 
                                {
                                    echo '
                                    <a class="nav-link" href="management.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                        User management
                                    </a>';
                                }
                            
                                if ($typeOfUser == 1) 
                                {
                                    echo '
                                    <a class="nav-link" href="logFiles.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                        Logs
                                    </a>';
                                }
                                if ($typeOfUser == 1 || $typeOfUser == 2) 
                                {
                                    echo '
                                    <a class="nav-link" href="schedule.php">
                                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                        Schedule
                                    </a>';
                                }
                            ?>

                        </div>
                    </div>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "southside_db");

                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                
                    $currentUser = isset($_SESSION['email']) ? mysqli_real_escape_string($conn, $_SESSION['email']) : '';
                
                    $query = "SELECT * FROM useraccount WHERE username ='$currentUser'";
                    $result = mysqli_query($conn, $query);
                
                    if ($result && mysqli_num_rows($result) > 0)
                    {
                        $row = mysqli_fetch_array($result);
                        echo "<div class='sb-sidenav-footer'>
                            <div class='small'>Logged in as:</div>
                            <div class='sb-sidenav-footer'>
                            <a>" . htmlspecialchars($row['username']) . "</a>
                        </div>";
                    }
                    mysqli_close($conn);
                    ?>
                
                    
                </nav>
            </div>
<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        <main>
        <h1>Appointments</h1>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Client Name</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($appointments as $row) {
                echo "<tr>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['start_time'] . "</td>";
                    echo "<td>" . $row['client_name'] ." " . $row['client_surname']. "</td>";

                echo "</tr>";
        }
        ?>
    </tbody>
</table>
    </table></main>
</body>
</html>