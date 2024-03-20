<?php
  include_once("config.php");
  $result = mysqli_query($conn,"SELECT * FROM product ");
  

?>



<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My first php coding</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
   rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
   crossorigin="anonymous">
</head>
<body>
  <a href="add.php">Add user</a>
<table class="table table-dark table-striped" >
  <thead >
    <tr>
      <th scope="col">id</th>
      <th scope="col">product name</th>
      <th scope="col">product price</th>
      <th scope="col">product qty</th>
      <th scope="col">product code</th>
      <th scope="col">update</th>
    </tr>
  </thead>


  <?php
  while($user_data= mysqli_fetch_assoc($result))
  {
        echo "<tr>";
        echo "<td>".$user_data['id']."</td>";
        echo "<td>".$user_data['product_name']."</td>";
        echo "<td>".$user_data['product_price']."</td>";
        echo "<td>".$user_data['product_qty']."</td>"; 
        echo "<td>".$user_data['product_code']."</td>";
        echo "<td><a href='edit.php?id=$user_data[id]'><button type='button' class='btn btn-primary editBtn' data-bs-toggle='modal' data-bs-target='#editProductModal'>Edit Product</button></a></td></tr>";  
        
  }
  ?>

<?php 
       
  
  include 'edit.php';
      
     echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js'></script>";         
  
  ?>
 
</table>
  
</body>
</html>