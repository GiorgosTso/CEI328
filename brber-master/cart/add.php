

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="kati">
    
      <div class="modal-header" id="title_center">
       Add New Product
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          
        </button>
        </div>
        
         <div class="modal-body" id="head">
  <a href="index.php">Go to home</a>
  <form method= post action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>>
    <div class="mb-3">
      <label for="name">Product Name</label>
      <input type="text" name="product_name">
    </div>

  <div class="mb-3">
    <label class="form-label">Product Price</label>
    <input type="text" name="product_price">
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Quantity</label>
    <input type="text" name="product_qty">
  </div>
  
  
  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Image</label>
    <input type="file" name="product_image">
  </div>

  <button name="Submit" type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  if(isset($_POST['Submit'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $product_image = $_POST['product_image'];
    
    

    include_once("config.php");

    $result = mysqli_query($conn,"INSERT INTO product (product_name,product_price,product_qty,product_code,product_image) VALUES ('$product_name','$product_price','$product_qty','$product_code','$product_image')");

    echo "User added successfully. <a href='index.php'>View Users</a>";
  }
?>
                </div>
			</div>
		</div>
</div>