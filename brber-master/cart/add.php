<?php

  
if(isset($_SESSION['product_name'])) {
  $productName = $_SESSION['product_name'];
  echo "Product Name: " . $productName;
}

if(isset($_SESSION['product_price'])) {
  $productPrice = $_SESSION['product_price'];
  echo " Product Price: $" . $productPrice . " ";
}

if(isset($_SESSION['product_qty'])) {
  $productQuantity = $_SESSION['product_qty'];
  echo " Product Quantity: " . $productQuantity;
}

// Always check if the session variable exists before using it to avoid undefined index notices
if(isset($_SESSION['product_id'])) {
  $productId = $_SESSION['product_id'];
  // Use $productId to fetch or manipulate the product
}

$name = $price = $qty = "";
$image = "../assets/img/logo.png";

$name_err = $price_err = $qty_err = "";

//$_SESSION['typeOfUser'] = '1';
if(empty(trim($productName))){//check if the email is in the database
   $name_err = "Please enter the name";
}
else {
   $name = $productName;
}

if(empty(trim($productPrice))){//check if the email is in the database
	$price_err = "Please enter the price";
 }
 else {
	$price =$productPrice;
 }
 
 if(empty(trim($productQuantity))){//check if the email is in the database
	$name_err = "Please enter the quantity";
 }
 else {
	$name = $productQuantity;
 }
?>

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
      <input type="text" name="product_name" class=" <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>">
      <span class="invalid-feedback"><?php echo $name_err; ?>
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

        </div>
			</div>
		</div>
</div>
<?php
  if(isset($_POST['Submit'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $product_image = $_POST['product_image'];
    
    


    $result = mysqli_query($conn,"INSERT INTO product (product_name,product_price,product_qty,product_image) VALUES ('$product_name','$product_price','$product_qty','$product_image')");

    
  }
  
?>
                