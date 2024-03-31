<?php
include '../php/config.php';

       
        $id = $_POST['update_id'];
            
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_qty = $_POST['product_qty'];
        $product_image = $_POST['product_image'];

        $query = "UPDATE product SET product_name = '$product_name', product_price = '$product_price', product_qty = '$product_qty', product_image = '$product_image' WHERE id = $id";
        $query_run = mysqli_query($conn, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:indexcode.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    
?>