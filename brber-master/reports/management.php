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
        session_start(); 
        include "../reports/header-sidebar.php";
    ?>
    <div id="layoutSidenav_content">
        <main>
        <?php
            $loggedInUserID = isset($_SESSION['id']) ? $_SESSION['id'] : null;
            include("../php/config.php"); 
            $query = "SELECT id FROM useraccount WHERE id = '$loggedInUserID'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $loggedInUserID = $row['id'];
        ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="d-inline"><i class="bi bi-people-fill"></i> Διαχείριση Χρήστη</h1>
                <div class="table-size-1 mt-4">
                    <table id="employees" class="table table-size-1 cell-border hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>TypeOfUser</th>
                                <th>Email</th>
                                <th>Phone number</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                           $query = "SELECT useraccount.typeOfUser, clients.id AS client_id, clients.name AS client_name, clients.surname AS client_surname, clients.email AS client_email, 
                           clients.phone AS client_phone, employee.id AS employee_id, employee.name AS employee_name, employee.surname AS employee_surname, 
                           employee.email AS employee_email, employee.phone AS employee_phone
                                   FROM useraccount
                                    LEFT JOIN clients ON useraccount.id = clients.id
                                    LEFT JOIN employee ON useraccount.id = employee.id";
                            $result = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                if (!empty($row['client_id'])) {
                                    echo "<td>" . $row['client_id'] . "</td>";
                                    echo "<td>" . $row['client_name'] . "</td>";
                                    echo "<td>" . $row['client_surname'] . "</td>";
                                    echo "<td>" . $row['typeOfUser'] . "</td>"; 
                                    echo "<td>" . $row['client_email'] . "</td>";
                                    echo "<td>" . $row['client_phone'] . "</td>";
                                } elseif (!empty($row['employee_id'])) {
                                    echo "<td>" . $row['employee_id'] . "</td>";
                                    echo "<td>" . $row['employee_name'] . "</td>";
                                    echo "<td>" . $row['employee_surname'] . "</td>";
                                    echo "<td>" . $row['typeOfUser'] . "</td>"; 
                                    echo "<td>" . $row['employee_email'] . "</td>";
                                    echo "<td>" . $row['employee_phone'] . "</td>";
                                } else {
                                    echo "<td colspan='6'>No data available</td>";
                                }
                                echo "</tr>";
                            }
                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="d-flex inline">
                    <form action='editUser.php' method='post'><button class='btn btn-primary'>Επεξεργασία</button></form>
                </div>						
            </div>
        </div>
        </main>
    </body>
</html>
