
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> PHP CRUD with Bootstrap Modal </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    
    <!-- extra -->
    
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

	<!-- CSS here -->
	
	<link rel="stylesheet" href="../assets/css/style.css">
	
</head>

<style>

    .modal-dialog {
        max-width: 50%; 
        margin: 30px auto; 
    }
    .table-responsive {
        min-width: 100%; 
    }

    .modal-dialog {
    
        max-height: 100%; /* Adjust this value based on your needs */
        display: flex;
        flex-direction: column;
        justify-content: center;
        overflow-y: hidden;
    }
    .modal-content {
        overflow-x: auto; 
        max-width: 100%;
        overflow-y: auto; /* Allows scrolling within the modal if the content is too tall */
        max-height: 750px;
    }
    body.modal-open {
    padding-right: 0 !important; /* Remove padding added by Bootstrap */
    overflow-y: hidden !important;
}
#exampleModal {
    padding-right: 0px !important;
    overflow-y: hidden !important;
}
body {
    padding-right: 0px !important;
}
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">My products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card">
                

                <?php
                    $currentDate = date('Y-m-d');
                    $id = $_SESSION['id'];
                    $stmt = $conn->prepare("SELECT * FROM orders WHERE ClientID = ? and receiptDate >= ?");
                    $stmt->bind_param('is', $id,$currentDate);
                    $stmt->execute();
                    $result = $stmt->get_result();
                ?>
                
                
                <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Products table 
                
            </div>
            <div class="card-body">
                <table id="datatablesSimple" class="table table-bordered table">
                     
                    <!-- this is to display the table -->
                        <thead>
                            <tr>
                                <th scope="col"> Name</th>
                                <th scope="col"> Products </th>
                                <th scope="col"> product Price </th>
                                <th scope="col"> Order Date </th>
                                <th scope="col"> receipt Date </th>
                                <!-- <th scope="col"> DELETE </th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                if($result)
                {
                    foreach($result as $row)
                    {
            ?>
                        
                            <tr>
                                <td> <?php echo $row['name']; ?> </td>
                                <td> <?php echo $row['products']; ?> </td>
                                <td> <?php echo $row['amount_paid']; ?> </td>
                                <td> <?php echo $row['order_date']; ?> </td>
                                <td> <?php echo $row['receiptDate']; ?> </td>
                                <!-- <td>
                                    
                                <form action="deleteOrder.php" method="post">
                                    <input type="hidden" name="deleteOrderId" value="<?= $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                                </form>
                                </td> -->
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
                    </div>
            </div>
        </div>
    </div>
    <!-- ____________________________________ -->

<script>
//     $(document).ready(function () {

// $('.deletebtn').on('click', function () {

//     $('#deleteOrderModal').modal('show');

//     $tr = $(this).closest('tr');

//     var data = $tr.children("td").map(function () {
//         return $(this).text();
//     }).get();

//     console.log(data);

//     $('#deleteOrderId').val(data[0]);

// });
// });
</script>


    </body>
</html>
