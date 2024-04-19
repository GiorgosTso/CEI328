<?php
include "../reports/header-sidebar.php";
?>
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

<div class="container-fluid">
                <h1 class="d-inline"><i class="bi bi-people-fill"></i> Διαχείριση Χρήστη</h1>
                <div class="table-size-1 mt-4">
                    <select id="userFilter">
                        <option value="all">All Users</option>
                        <option value="client">Clients</option>
                        <option value="employee">Employees</option>
                    </select>
                    <table id="employees" class="table table-size-1 cell-border hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Type Of User</th>
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
                                    if ($row['typeOfUser'] == 3) {
                                        echo "<td>Client</td>";
                                    } elseif ($row['typeOfUser'] == 2) {
                                        echo "<td>Employee</td>";
                                    } else {
                                        echo "<td>" . $row['typeOfUser'] . "</td>";
                                    }
                                    echo "<td>" . $row['client_email'] . "</td>";
                                    echo "<td>" . $row['client_phone'] . "</td>";
                                } elseif (!empty($row['employee_id'])) {
                                    echo "<td>" . $row['employee_id'] . "</td>";
                                    echo "<td>" . $row['employee_name'] . "</td>";
                                    echo "<td>" . $row['employee_surname'] . "</td>";
                                    if ($row['typeOfUser'] == 3) {
                                        echo "<td>Client</td>";
                                    } elseif ($row['typeOfUser'] == 2) {
                                        echo "<td>Employee</td>";
                                    } else {
                                        echo "<td>" . $row['typeOfUser'] . "</td>";
                                    }
                                    echo "<td>" . $row['employee_email'] . "</td>";
                                    echo "<td>" . $row['employee_phone'] . "</td>";
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
        <script>
            // JavaScript for filtering the table based on the selected option
            document.getElementById('userFilter').addEventListener('change', function () {
                var value = this.value.toLowerCase();
                var rows = document.querySelectorAll('#employees tbody tr');

                rows.forEach(function (row) {
                    var userType = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
                    if (value === 'all' || userType === value) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        </script>
    </body>
</html>
