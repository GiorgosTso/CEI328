<?php
include '../php/config.php';

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM product WHERE id='$id'";
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

