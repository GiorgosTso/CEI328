<?php 
session_start();
include '../php/config.php';


$pname = $pprice = $pqty = "";
$pimage = $product_image = "photo.png";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['insertdata'])) {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_qty = $_POST['product_qty'];

        // Handle file upload
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $product_image = $_FILES['product_image']['name'];
            $temp_name = $_FILES['product_image']['tmp_name'];
            $upload_path = 'uploads/'; // Ensure this directory exists and is writable
            $upload_file = $upload_path . basename($product_image);

            // Attempt to move the uploaded file to your desired directory
            if (move_uploaded_file($temp_name, $upload_file)) {
                echo '<script> alert("File uploaded successfully."); </script>';
            } else {
                echo '<script> alert("Failed to upload file."); </script>';
            }
        } else {
            $product_image = "photo.png"; // Default image or handle error
        }

        $query = "INSERT INTO product (product_name, product_price, product_qty, product_image) VALUES ('$product_name', '$product_price', '$product_qty', '$product_image')";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            echo '<script> alert("Data Saved"); </script>';
            header('Location: indexcode.php');
        } else {
            echo '<script> alert("Data Not Saved"); </script>';
        }
    }
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
        else {
            $pprice = $_POST["product_price"];
        }
        
        if(empty(trim($_POST["product_qty"]))){
            $quantity_err = "Enter the Quantity "; 

        }
        else {
            $pqty = ($_POST["product_qty"]);
        }
        if(empty($name_err) && empty($price_err) && empty($quantity_err)){
        
            $query = "UPDATE product SET product_name = '$pname', product_price = '$pprice', product_qty = '$pqty', product_image = '$pimage' WHERE id = $id";
        $query_run = mysqli_query($conn, $query);
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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">


                    <div class="modal-body">
                        <div class="form-group">
                            <label> Name </label>
                            <input type="text" name="product_name" id="prName" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" placeholder="Enter product name">
                            <span class="invalid-feedback"><?php echo $name_err; ?>
                        </div>

                        <div class="form-group">
                            <label> Price </label>
                            <input type="number" name="product_price" id="prPrice" class="form-control" placeholder="Enter product price">
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

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="POST" id="updateForm">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label for="product_name"> Name </label>
                            <input type="text" name="product_name" id="product_name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $pname; ?>" placeholder="Enter product name">
                            <span class="invalid-feedback" id="name_err"><?php echo $name_err; ?>
                            <span class="error-message" id="product_name_error" style="color: red;"></span>
                        </div>

                        <div class="form-group">
                            <label> Product price </label>
                            <input type="text" name="product_price" id="product_price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>"
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
                            <input type="file" name="product_image" id="product_image" class="<?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" >
                            <span class="invalid-feedback"><?php echo $name_err; ?>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-secondary" onclick="validateForm()">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <script>

var button = document.querySelector("button[name='updatedata']"); 

button.disabled = true;

// Function to check input states and enable/disable the button
function stateHandle() {
    var productName = document.getElementById('product_name').value.trim();
    var price = document.getElementById('product_price').value.trim();
    var quantity = document.getElementById('product_qty').value.trim();
    
    // Enable button only if all fields are filled
    button.disabled = !productName || !price || !quantity;
}

// Attach the stateHandle function to the change event for all required inputs
document.getElementById('product_name').addEventListener("input", stateHandle);
document.getElementById('product_price').addEventListener("input", stateHandle);
document.getElementById('product_qty').addEventListener("input", stateHandle);
</script>

    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
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
                    <a href="index.php"><button type="button" class="btn btn-info btn-round " data-toggle="modal" data-target="#loginModal">
                        GO BACK
                    </button></a>
                </div>
            </div>
 
            <div class="card">
                <div class="card-body">

                    <?php
                

                $query = "SELECT * FROM product";
                $query_run = mysqli_query($conn, $query);
            ?>
                    <table id="datatableid" class="table table-bordered table"> 
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
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
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
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
                </div>
            </div>


        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    
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


</body>
</html>