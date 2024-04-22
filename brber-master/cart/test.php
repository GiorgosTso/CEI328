<?php
include "../php/config.php";
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
</head>
<body>
    <div class="container">
    <a href="test1.php">aaaaaaaaaaaaaa</a>
        <h2 class="mt-5">Products List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                              <td>{$row['id']}</td>
                              <td>{$row['product_name']}</td>
                              <td>{$row['product_price']}</td>
                              <td>{$row['product_qty']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>