<?php
  session_start();
  include("../php/config.php");


  if(isset($_POST['update'])){//einai update epeidi einai to input pou kamnei submit
    $id = $_POST['id'];
    $product_name = $_POST['name'];
    $product_price = $_POST['price']; 
    $product_qty = $_POST['quantity']; 
    $result = mysqli_query($conn,"UPDATE product SET product_name = '$product_name', product_price = '$product_price', product_qty = '$product_qty' WHERE id = $id");

    header('Location:index.php');
  }
 

?>

<?php
$id = $_GET['id'];

// Fetech user data based on id
    $sql = mysqli_query($conn,"SELECT * FROM product WHERE id=$id");
    
while($user_data = mysqli_fetch_array($sql))
    {
      
      $product_name = $user_data['product_name'];
      $product_price = $user_data['product_price']; 
      $product_qty = $user_data['product_qty']; 
      
    }  
  
?>

<html>
<head>	
	<title>Edit User Data</title>
	
</head>

<body>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
    <div class="modal-content">
      <div class="modal-header border-bottom-0">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-title text-center">
          <h4>Login</h4>
        </div>
        <div class="d-flex flex-column text-center">
          <form name="update_user" method="post" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
		<table border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name" value=<?php echo $product_name;?>></td>
			</tr>
			<tr> 
				<td>Price</td>
				<td><input type="number" name="price" value=<?php echo $product_price;?>></td>
			</tr>
			<tr> 
				<td>Mobile</td>
				<td><input type="number" name="quantity" value=<?php echo $product_qty;?>></td>
			</tr>			
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="update"></td>
			</tr>
		</table>
	</form>
          
          
        </div>
      </div>
    <!-- </div> -->
      
  </div>
</div>
</body>
</html>