<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My first php coding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
   rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
   crossorigin="anonymous">
</head>
<body>
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
    <label for="exampleInputPassword1" class="form-label">Product Code</label>
    <input type="text" name="product_code">
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
    $product_code = $_POST['product_code'];
    $product_image = $_POST['product_image'];
    
    

    include_once("config.php");

    $result = mysqli_query($conn,"INSERT INTO product (product_name,product_price,product_qty,product_code,product_image) VALUES ('$product_name','$product_price','$product_qty','$product_code','$product_image')");

    echo "User added successfully. <a href='index.php'>View Users</a>";
  }
?>
  
</body>
</html>