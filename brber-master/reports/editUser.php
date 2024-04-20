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
<?php 
        session_start();
        include "../reports/header-sidebar.php";
    ?>
<body class="sb-nav-fixed">
<?php
            $loggedInUserID = isset($_SESSION['id']) ? $_SESSION['id'] : null; 
            include("../php/config.php"); 
            $query = "SELECT id FROM useraccount WHERE id = '$loggedInUserID'";
            $result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
} 
else 
{
    $row = mysqli_fetch_assoc($result);
    if ($row !== null) {
        $loggedInUserID = $row['id'];
    } else {
        echo "No rows found.";
    }
}

        ?>

        <div id="layoutSidenav_content">
            <div class="container-fluid">
                <h1 class="d-inline"><i class="bi bi-people-fill"></i> Διαχείριση Χρήστη</h1>
                <div class="table-size-1 mt-4">
                <form id="updateUser" action="updateUser.php" method="post">
                <div class="mb-3">
                    <br>
                    <label for="employee">Παρακαλώ επιλέξτε λογαριασμό </label>
                    <?php
                        $query = "SELECT useraccount.typeOfUser, clients.id AS client_id, clients.name AS client_name, clients.surname AS client_surname, clients.email AS client_email, clients.phone AS client_phone,
                        employee.id AS employee_id, employee.name AS employee_name, employee.surname AS employee_surname, employee.email AS employee_email, employee.phone AS employee_phone
                        FROM useraccount
                        LEFT JOIN clients ON useraccount.id = clients.id
                        LEFT JOIN employee ON useraccount.id = employee.id";

                        $result = mysqli_query($conn, $query);

                        echo "<select class='form-control' name='employee' id='employee' onchange='populateFormFields()'>";
                        echo "<option value='' selected>Select a User</option>";
                        if (mysqli_num_rows($result) > 0) 
                        {
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['client_id']) {
                                    echo "<option value='" . $row['client_id'] . "' data-lastname='" . $row['client_surname'] . "' data-firstname='" . $row['client_name'] . "' data-email='" . $row['client_email'] . "' data-phone='" . $row['client_phone'] . "'>" . $row['client_surname'] . " " . $row['client_name'] . "</option>";
                                }
                                if ($row['employee_id']) {
                                    echo "<option value='" . $row['employee_id'] . "' data-lastname='" . $row['employee_surname'] . "' data-firstname='" . $row['employee_name'] . "' data-email='" . $row['employee_email'] . "' data-phone='" . $row['employee_phone'] . "'>" . $row['employee_surname'] . " " . $row['employee_name'] . "</option>";
                                }
                            }
                        } 
                        else 
                        {
                            echo "<option value=''>No options found</option>";
                        }
                        echo "</select>";
                        echo "<input type='hidden' name='row_id' id='row_id' value=''>";
                    ?>

                </div>       
                <div class="col-md-12">
                <div class="form-floating mb-3 mb-md-3">
                    <p style="color: black;" for="name">Name:</label>
                    <input class="form-control" id="name" name="name" placeholder="Name" required />
                </div>
                </div>
                <br>
                <div class="col-md-12">
                <div class="form-floating mb-3 mb-md-3">
                    <p style="color: black;" for="surname">Surname:</label>
                    <input class="form-control" id="surname" name="surname" placeholder="Surname" required />
                </div>
                </div>
                <br>
                <select class="form-control" name="typeOfUser" required style="max-width: 440px;">
                    <option value="" disabled selected>Επιλέξτε τον τύπο χρήστη/Select user type</option>
                    <option value="1">Admin/Διαχειριστής</option>
                    <option value="2">Employee/Υπάλληλος</option>
                    <option value="3">Client/Πελάτης</option>
                </select>
                <br>
                <div class="col-md-12">
                <div class="form-floating mb-3 mb-md-3">
                    <p style="color: black;" for="email">Email:</label>
                    <input class="form-control" id="email" name="email" type="email" placeholder="Εmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required />
                </div>
                </div>
                <br>
                <div class="form-floating">
                    <p style="color: black;" for="phone">Κινητό Τηλέφωνο:</label>
                    <input class="form-control" id="phone" name="phone" placeholder="Κινητό τηλέφωνο/Phone number" pattern="[0-9]{8}" required/>
                </div>
                </div>                            
                <button type="submit" class="btn btn-primary">Αποθήκευση</button>
                </form>
                </div>
            </div>
        </div>
    <script>
        function populateFormFields() 
        {
            var select = document.getElementById("employee");
            var selectedOption = select.options[select.selectedIndex];
            
            var name = selectedOption.getAttribute("data-firstname");
            var surname = selectedOption.getAttribute("data-lastname");
            var email = selectedOption.getAttribute("data-email");
            var phone = selectedOption.getAttribute("data-phone");

            document.getElementById("name").value = name; 
            document.getElementById("surname").value = surname;  
            document.getElementById("email").value = email;
            document.getElementById("phone").value = phone;
        }          
    </script>
        