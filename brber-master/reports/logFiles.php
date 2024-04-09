<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Charts - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "../reports/header-sidebar.php";
    ?>
    <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="d-inline"><i class="bi bi-people-fill"></i> Log's</h1>
                <div class="table-size-1 mt-4">
                    <table id="employees" class="table table-size-1 cell-border hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Action Taken</th>
                            </tr>
                        </thead>
        <tbody>
            <?php
                include_once("../php/config.php"); 

                if ($conn) {
                    $query = "SELECT logId, date, action FROM log";

                    $result = mysqli_query($conn, $query);

                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['logId'] . "</td>";
                            echo "<td>" . $row['date'] . "</td>";
                            echo "<td>" . $row['action'] . "</td>";
                            echo "</tr>";
                        }
                        mysqli_free_result($result);
                    } else {
                        echo "Error executing query: " . mysqli_error($conn);
                    }

                    mysqli_close($conn);
                } else {
                    echo "Error connecting to database.";
                }
            ?>
        </tbody>
    </table>
</body>
</html>

