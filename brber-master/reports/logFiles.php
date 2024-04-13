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
    <script>
        function reverseOrder() {
            var table = document.getElementById("employees");
            var tbody = table.getElementsByTagName("tbody")[0];
            var rows = tbody.getElementsByTagName("tr");
            var reversedRows = [];
            
            // Copy rows into a new array in reverse order
            for (var i = rows.length - 1; i >= 0; i--) {
                reversedRows.push(rows[i]);
            }
            
            // Clear existing rows from the table
            tbody.innerHTML = "";
            
            // Append rows in reversed order
            for (var i = 0; i < reversedRows.length; i++) {
                tbody.appendChild(reversedRows[i]);
            }
        }
    </script>
</head>
<body class="sb-nav-fixed">
    <?php 
        include "../reports/header-sidebar.php";
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid">
            <h1 class="d-inline"><i class="bi bi-people-fill"></i> Logs</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="filter">Filter by Action:</label>
                    <input type="text" id="filter" name="filter" class="form-control" placeholder="Enter action keyword">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <!-- Add the button to reverse order -->
                <button type="button" class="btn btn-secondary" onclick="reverseOrder()">Reverse Order</button>
            </form>
            <div class="table-size-1 mt-4">
                <table id="employees" class="table table-size-1 cell-border hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Action Taken</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            include_once("../php/config.php");

                            if ($conn) {
                                $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
                                $query = "SELECT logId, date, action FROM log";

                                // Add filter condition if provided
                                if (!empty($filter)) {
                                    $query .= " WHERE action LIKE ?";
                                }

                                $query .= " ORDER BY logId DESC";

                                $stmt = $conn->prepare($query);
                                if (!empty($filter)) {
                                    // Bind the filter value dynamically
                                    $filter = '%' . $filter . '%'; // Add wildcards to match any part of the action message
                                    $stmt->bind_param("s", $filter);
                                }
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['action'] . "</td>";
                                        echo "</tr>";
                                    }
                                    $result->free();
                                } else {
                                    echo "Error executing query: " . $conn->error;
                                }

                                $stmt->close();
                                mysqli_close($conn);
                            } else {
                                echo "Error connecting to database.";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
