<?php
include "../php/config.php";  // Ensure your database configuration is correct

$currentTime = time();
$addedTime = $currentTime + 90;  // Current time plus 90 seconds
$addedDateTime = date('Y-m-d H:i:s', $addedTime);
$product_name = $_POST['product_name'];


    // Fetch product quantity from 'product' table
    $stmt2 = $conn->prepare("SELECT product_qty FROM product WHERE product_name = ?");//thelo na vro to qty 
    $stmt2->bind_param('s', $product_name);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $row1 = $result2->fetch_assoc();
    $current_stock_qty = $row1['product_qty'] ?? 0;

    // Fetch cart items that need to be updated or removed
    $stmt = $conn->prepare("SELECT * FROM cart WHERE timer <= ?");//filtraro gia na vro poia tha prepei na figoun
    $stmt->bind_param('s', $addedDateTime);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $updatedQty = $row['qty'] + $current_stock_qty;
            $stmtUpdate = $conn->prepare("UPDATE product SET product_price = ?, product_qty = ? WHERE product_name = ?");//ta stelno ston product
            $stmtUpdate->bind_param("dis", $row['product_price'], $updatedQty, $row['product_name']);
            $stmtUpdate->execute();

            $stmtDelete = $conn->prepare("DELETE FROM cart WHERE id = ?");//ta diagrafo ekei pou einai 
            $stmtDelete->bind_param('i', $row['id']);
            $stmtDelete->execute();
        }
    }

    // Display remaining cart items
    $stmt1 = $conn->prepare("SELECT * FROM cart WHERE timer >= ?");
    $stmt1->bind_param('s', $addedDateTime);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    if ($result1->num_rows > 0) {
        echo '<h2 class="mt-5">Products List</h2>
              <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Timer</th>
                        
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result1->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_price']}</td>
                    <td>{$row['qty']}</td>
                    <td>" . ($row['timer'] ? $row['timer'] : 'N/A') . "</td>
                     
                  </tr>";
        }
        echo '</tbody>
              </table>';
    } else {
        echo "No products found that are expiring after {$addedDateTime}.";
    }

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
    <a href="test.php">aaaaaaaaaa</a>
        
</body>
</html>