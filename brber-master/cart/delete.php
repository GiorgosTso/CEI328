<?php
  include_once('config.php');
  $id = $_GET['id'];
  $result = mysqli_query($conn,"DELETE FROM product where id = $id");

  header("Location: viewProducts.php");
?>