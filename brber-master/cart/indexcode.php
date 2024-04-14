<?php 
session_start();
include '../php/config.php';

$pname = $pprice = $pqty = "";
$product_image = 'photo.png';  // Default image
$previous_name = $previous_price = $previous_qty = $previous_image = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insertdata'])) {
    $product_name = $_POST['product_name'];
    $product_price = floatval($_POST['product_price']);
    $product_qty = $_POST['product_qty'];

    // Handle file upload
    if (isset($_FILES['product_image']['name']) && $_FILES['product_image']['name'] != "") {
        $targetDir = "uploads/";  // Ensure this directory exists and is writable
        $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    
        // Check file size - example: 5MB limit
        if ($_FILES["product_image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }
    
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["product_image"]["name"])). " has been uploaded.<br>";
                $product_image = $targetFile; // Update to the actual path of the uploaded file
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }
    //____________________________________________________telos add photo______________________________________________________
    



    // Insert into database
    $query = "INSERT INTO product (product_name, product_price, product_qty, product_image) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdis", $product_name, $product_price, $product_qty, $product_image);
    $previous_name = $product_name;
    $previous_price = $product_price;
    $previous_qty = $product_qty;
    $previous_image = $product_image;
    
    
    if ($stmt->execute()) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: indexcode.php?status=success');
    } else {
        header('Location: indexcode.php?status=error');
    }
    $stmt->close();
}
    
    if(isset($_POST['updatedata'])) {
        $id = $_POST['update_id'];
    
        if(empty(trim($_POST["product_name"]))){
            $name_err = "Enter the name "; 

        }
        else {
            $pname = trim($_POST["product_name"]); 
        }
        
        if(empty(trim($_POST["product_price"]))){
            $price_err = "Enter the price "; 

        }
        else if(trim($_POST["product_price"]) < 0){
            $pprice_err = "Price can't be negative";
        }
        else {
            $pprice = $_POST["product_price"];
        }
        
        if(empty(trim($_POST["product_qty"]))){
            $quantity_err = "Enter the Quantity "; 

        }
        else if(trim($_POST["product_qty"]) < 0){
            $pprice_err = "Quantity can't be negative";
        }
        else {
            $pqty = ($_POST["product_qty"]);
        }
        if(empty($name_err) && empty($price_err) && empty($quantity_err)){
                    $product_name = $_POST['product_name'] ?? '';
                    $product_price = isset($_POST['product_price']) ? floatval($_POST['product_price']) : 0.00;
                    $product_qty = $_POST['product_qty'] ?? 0;
                    $update_id = $_POST['update_id'] ?? 0;
                    $product_image = 'photo.png';  // Default image if none uploaded or if upload fails
            
                    // Handle file upload
                    if (!empty($_FILES['edit_image']['name'])) {
                        $targetDir = "uploads/";
                        $fileName = basename($_FILES["edit_image"]["name"]);
                        $targetFile = $targetDir . $fileName;
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
                        // Check if image file is an actual image
                        $check = getimagesize($_FILES["edit_image"]["tmp_name"]);
                        if ($check !== false) {
                            echo "File is an image - " . $check["mime"] . ".<br>";
                        } else {
                            echo "File is not an image.<br>";
                            $uploadOk = 0;
                        }
            
                        // Check file size - example: 5MB limit
                        if ($_FILES["edit_image"]["size"] > 5000000) {
                            echo "Sorry, your file is too large.<br>";
                            $uploadOk = 0;
                        }
            
                        // Allow certain file formats
                        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                            $uploadOk = 0;
                        }
            
                        // Try to upload file if all checks pass
                        if ($uploadOk == 1) {
                            if (move_uploaded_file($_FILES["edit_image"]["tmp_name"], $targetFile)) {
                                echo "The file ". htmlspecialchars($fileName). " has been uploaded.<br>";
                                $product_image = $targetFile;  // Use uploaded file
                            } else {
                                echo "Sorry, there was an error uploading your file.<br>";
                            }
                        }
                    }
            
                    // Prepare SQL statement to update product data
                    $query = "UPDATE product SET product_name = ?, product_price = ?, product_qty = ?, product_image = ? WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    if ($stmt) {
                        $stmt->bind_param("sdisi", $product_name, $product_price, $product_qty, $product_image, $update_id);
                        if ($stmt->execute()) {
                            $previous_name = $product_name;
                            $previous_price = $product_price;
                            $previous_qty = $product_qty;
                            $previous_image = $product_image;
                            header('Location: indexcode.php?status=success');
                            exit;
                        } else {
                            echo "Error updating record: " . $stmt->error;
                            header('Location: indexcode.php?status=error');
                            exit;
                        }
                        $stmt->close();
                    } else {
                        echo "Error preparing statement: " . $conn->error;
                    }
                } else {
                    echo "Validation errors occurred.";
                }
            }	

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> PHP CRUD with Bootstrap Modal </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="css/indexcode.css">
    <link href="css/styles.css" rel="stylesheet" />
    
    <!-- extra -->
    
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

	<!-- CSS here -->
	
	<link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>Orders</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <style>
        .jumbotron {
            position:relative;
            top: -450px;
    
}
    </style>
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        
        <div class="modal-dialog" role="document" id="kati">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
<!-- add products -->
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">

                <div id="messageArea" class="alert alert-danger" style="display: none;"></div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="product_name" id="prName" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter product name">
                            <span class="invalid-feedback"><?php echo $name_err; ?>
                        </div>

                        <div class="form-group">
                            <label> Price </label>
                            <input type="number" name="product_price" step="0.01" id="prPrice" class="form-control" placeholder="Enter product price">
                        </div>

                        <div class="form-group">
                            <label> Quantity </label>
                            <input type="number" name="product_qty" id="prQty" class="form-control" placeholder="Enter product quantity">
                        </div>

                        <div class="form-group">
                            <label> Image </label>
                            <input type="file" name="product_image">
                            
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-secondary">Save Data</button>
                    </div>
                </form>
                
                <script>
                    function validateForm() {
                        var price = document.getElementById('prPrice').value;
                        var quantity = document.getElementById('prQty').value;
                    
                        // Check for empty fields
                        if (price.trim() === "" || quantity.trim() === "") {
                            messageArea.textContent = "Price and quantity cannot be empty."; // Set error message
                            messageArea.style.display = 'block';
                            return false; // Prevent form submission if any field is empty
                        }
                    
                        // Convert to Number and check for negative values
                       
                    
                        if (price <= 0 || quantity <= 0) {
                            messageArea.textContent = "Price and quantity must be greater than zero."; // Set error message
                            messageArea.style.display = 'block';
                            return false; // Prevent form submission if values are non-positive
                        }
                       
                            
                        return true; // Allow form submission if all validations pass
                    }
                    </script>
                
                <script>

var button2 = document.querySelector("button[name='insertdata']"); 

button2.disabled = true;

// Function to check input states and enable/disable the button
function Handle() {
    var productName = document.getElementById('prName').value.trim();
    var price = document.getElementById('prPrice').value.trim();
    var quantity = document.getElementById('prQty').value.trim();
    
    // Enable button only if all fields are filled
    button2.disabled = !productName || !price || !quantity;
}

// Attach the stateHandle function to the change event for all required inputs
document.getElementById('prName').addEventListener("input", Handle);
document.getElementById('prPrice').addEventListener("input", Handle);
document.getElementById('prQty').addEventListener("input", Handle);
</script>


            </div>
        </div>
    </div>
<!-- end of the first modal in for adding products -->
    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">

                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" id="updateForm" onsubmit="return updateValidation()" enctype="multipart/form-data">
                    <div id="messageError" class="alert alert-danger" style="display: none;"></div>
                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label for="product_name"> Name </label>
                            <input type="text" name="product_name" id="product_name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pname; ?>" placeholder="Enter product name">
                            <span class="invalid-feedback" id="name_err"><?php echo $name_err; ?>
                            <span class="error-message" id="product_name_error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label> Product price </label>
                            <input type="text" name="product_price" step="0.01" id="product_price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
                                placeholder="Enter product price">
                                <span class="error-message" id="price_error" style="color: red;"></span>   
                        </div>

                        <div class="form-group">
                            <label> Product Quantity </label>
                            <input type="text" name="product_qty" id="product_qty" class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>"
                                placeholder="Enter product quantity">
                                <span class="error-message" id="qty_error" style="color: red;"></span>
                        </div>
                        
                        <div class="form-group">
                            <label> Product Image </label>
                            <input type="file" name="edit_image" id="product_image" class="<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" >
                            <span class="invalid-feedback"><?php echo $name_err; ?>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-secondary" >Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
    function updateValidation() {
        var price = document.getElementById('product_price').value;
        var qty = document.getElementById('product_qty').value;
        var messageError = document.getElementById('messageError');

        if (price <= 0 || qty <= 0) {
            messageError.textContent = "Price and quantity must be greater than zero.";
            messageError.style.display = 'block';
            return false;
        } else {
            messageError.style.display = 'none';
            return true;
        }
    }
</script>
    
    <script>

var button = document.querySelector("button[name='updatedata']"); 

button.disabled = true;

// Function to check input states and enable/disable the button
function stateHandle() {
    var productName = document.getElementById('product_name').value.trim();
    var price = document.getElementById('product_price').value.trim();
    var quantity = document.getElementById('product_qty').value.trim();
    var image = document.getElementById('product_image').value.trim();
    
    // Enable button only if all fields are filled
    button.disabled = !productName || !price || !quantity;
}

// Attach the stateHandle function to the change event for all required inputs
document.getElementById('product_name').addEventListener("input", stateHandle);
document.getElementById('product_price').addEventListener("input", stateHandle);
document.getElementById('product_qty').addEventListener("input", stateHandle);

</script>

    <!-- DELETE POP UP FORM  -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Student Data</h5>
                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="deletecode.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <h4>Do you want to Delete this Data ??</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                    <button type="submit" name="deletedata" class="btn btn-primary">Yes !! Delete it.</button>
                </div>
            </form>
        </div>
    </div>
</div>



    <div class="container">
    <style>
    @media (min-width: 601px) {
      .card-body {
        max-height: 500px;
        overflow-x: auto;
      }
    }
</style>
        <div class="jumbotron">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div id="successMessage" class="alert alert-success" style="position: absolute; top: 15px; left: 50%; transform: translateX(-50%); background: #f0f0f0; padding: 10px; border-radius: 5px; border: 1px solid green;">
                Changes Saved Successfully!
            </div>
            <script>
                setTimeout(function() {
                    var successMessage = document.getElementById('successMessage');
                    if (successMessage) {
                        successMessage.style.display = 'none';
                    }
                }, 3000); // Message disappears after 3 seconds
            </script>
        <?php endif; ?> 
            <div class="card">
                <h2> Edit Products </h2>
                
            </div>
            <style>
                #body_buttons {
                    display: flex;
                    justify-content: space-between;
                }
            </style>
            <div class="card">
                <div class="card-body" id= "body_buttons">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal">
                        ADD PRODUCTS
                    </button>
                    <a href="order.php"><button type="button" class="btn btn-info btn-round " data-toggle="modal" data-target="#loginModal">
                        GO BACK
                    </button></a>
                </div>
            </div>
 
            <div class="card">
                

                    <?php
                

                $query = "SELECT * FROM product";
                $query_run = mysqli_query($conn, $query);
            ?>
            
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                DataTable Example
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table">
                     
                    <!-- this is to display the table -->
                        <thead>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col"> Name</th>
                                <th scope="col"> Product Price </th>
                                <th scope="col"> product Quantity </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                        </thead>
                        
                        <tfoot>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col"> Name</th>
                                <th scope="col"> Product Price </th>
                                <th scope="col"> product Quantity </th>
                                <th scope="col"> EDIT </th>
                                <th scope="col"> DELETE </th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        
                            <tr>
                                <td> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['product_name']; ?> </td>
                                <td> <?php echo $row['product_price']; ?> </td>
                                <td> <?php echo $row['product_qty']; ?> </td>
                                <td>
                                    <button type="button" class="btn btn-success editbtn"> EDIT </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deletebtn"> DELETE </button>
                                </td>
                            </tr>
                        
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
            </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    
    <script>
$(document).ready(function() {
    $('#updateDataButton').click(function(event) {
        // Initially, no errors
        let hasErrors = false;
        
        // Clear all previous error messages
        $('.error-message').text('');

        // Validate product name
        if ($('#product_name').val().trim() === '') {
            $('#product_name_error').text('Please enter the product name.');
            hasErrors = true;
        }

        // Validate product price
        if ($('#product_price').val().trim() === '') {
            $('#product_price_error').text('Please enter the product price.');
            hasErrors = true;
        }

        // Validate product quantity
        if ($('#product_qty').val().trim() === '') {
            $('#product_qty_error').text('Please enter the product quantity.');
            hasErrors = true;
        }

        // Add similar checks for other inputs...

        // Prevent form submission if there are errors
        if (hasErrors) {
            event.preventDefault();
        }
        // Otherwise, the form will submit normally
    });
});
</script>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script>


    <script>
        $(document).ready(function () {

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });

        });
    </script>

    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#product_name').val(data[1]);
                $('#product_price').val(data[2]);
                $('#product_qty').val(data[3]);
                $('#product_image').val(data[4]);
            });
        });
    </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.7/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>