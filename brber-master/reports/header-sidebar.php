<?php
ob_start(); 

session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$typeOfUser = isset($_SESSION['typeOfUser']) ? $_SESSION['typeOfUser'] : null; 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sidenav Light - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Admin Module</a>
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
        <?php
        ob_end_flush(); 
        ?>