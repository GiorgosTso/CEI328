<?php

include '../php/config.php';

if(isset($_POST['insertdata']))
{
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];
    $product_image = $_POST['product_image'];
    
    
   
    $query = "INSERT INTO product (product_name,product_price,product_qty,product_image) VALUES ('$product_name','$product_price','$product_qty','$product_image')";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        header('Location: indexcode.php?status=success');
        exit;
    }
    else
    {
        header('Location: indexcode.php?status=error');
        exit;
    }
}

?>