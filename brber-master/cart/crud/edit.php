<?php
  include_once('config.php');
  
  

  if(isset($_POST['update'])){//einai update epeidi einai to input pou kamnei submit
    $id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price']; 
    $product_qty = $_POST['product_qty']; 
    $proudct_code = $_POST['product_code'];
    $result = mysqli_query($conn,"UPDATE product SET product_name = '$product_name', product_price = '$product_price', product_qty = '$product_qty', produ ct_code = '$proudct_code' WHERE id = $id");

    header('Location:index.php');
  }
 

?>

<?php
if (isset($_GET['id'])) {
    $id =$_GET['id'];
    $result = mysqli_query($conn,"SELECT * FROM product WHERE id=$id");
    
while($user_data = mysqli_fetch_array($result))
    {
      
      $product_name = $user_data['product_name'];
      $product_price = $user_data['product_price']; 
      $product_qty = $user_data['product_qty']; 
      $product_code = $user_data['product_code'];
    }  
  }
?>

<!-- Modal Structure -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Your form goes here -->
        <form name="update_user" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
          
          <div class="mb-3">
            <label>Name of the product</label>
            <input type="text" name="product_name" class="form-control" id="product_name" value=<?php echo $product_name; ?>>
          </div>
          <div class="mb-3">
            <label>Product price</label>
            <input type="text" name="product_price" class="form-control" id="product_price" value=<?php echo $product_price; ?>>
          </div>
          <div class="mb-3">
            <label>Quantity</label>
            <input type="text" name="product_qty" class="form-control" id="product_qty" value=<?php echo $product_qty; ?>>
          </div>
          <div class="mb-3">
            <label>Product Code</label>
            <input type="text" name="product_code" class="form-control" id="product_code" value=<?php echo $product_code; ?>> <!-- Assume this was corrected to $product_code -->
          </div>
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">  
          <input name="update" value="Update" type="submit" class="btn btn-primary">
        </form>
      </div>
    </div>
  </div>
</div>


</body>
</html>
  
</body>
</html>