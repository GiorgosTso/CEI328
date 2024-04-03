<?php include "../php/config.php"?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
<?php include "tables.php"?>
<?php
                $query = "SELECT * FROM orders";
                $query_orders = mysqli_query($conn, $query);
            ?>
    
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>products</th>
                                            <th>amount paid</th>
                                            <th>receipt date</th>
                                            <th>order date</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>email</th>
                                            <th>products</th>
                                            <th>amount paid</th>
                                            <th>receipt date</th>
                                            <th>order date</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                     if($query_orders)
                                        {
                                            foreach($query_orders as $row)
                                            {
                                    ?>
                                                
                                <tr>
                                    <td> <?php echo $row['name']; ?> </td>
                                    <td> <?php echo $row['email']; ?> </td>
                                    <td> <?php echo $row['products']; ?> </td>
                                    <td> <?php echo $row['amount_paid']; ?> </td>
                                    <td> <?php echo $row['receiptDate']; ?> </td>
                                    <td> <?php echo $row['order_date']?> </button>
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
                    
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>
</html>