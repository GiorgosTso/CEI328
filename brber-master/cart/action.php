<?php
	session_start();
	require '../php/config.php';
	
	$cid = $_SESSION['id'];
	
	// Add products into the cart table
	if (isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$pname = $_POST['pname'];
		$pprice = $_POST['pprice'];
		$pimage = $_POST['pimage'];
		$pqty = $_POST['pqty'];
	
		// Retrieve the current stock quantity from the database for the specific product
		$stmt = $conn->prepare("SELECT product_qty FROM product WHERE id = ?");
		$stmt->bind_param('i', $pid);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($row = $result->fetch_assoc()) {
			$current_stock_qty = $row['product_qty'];
	
			if ($current_stock_qty >= $pqty) {
				// There is enough stock to fulfill the order
				$total_price = $pprice * $pqty; // Calculate total price based on quantity
				$new_stock_qty = $current_stock_qty - $pqty; // Calculate new stock quantity
	
				// Update the stock quantity in the database
				$update_stmt = $conn->prepare("UPDATE product SET product_qty = ? WHERE id = ?");
				$update_stmt->bind_param('ii', $new_stock_qty, $pid);
				$update_stmt->execute();
	
				// Check if this product is already in the cart
				$check_cart_stmt = $conn->prepare("SELECT id FROM cart WHERE id = ? AND ClientID = ?");
				$check_cart_stmt->bind_param('ii', $pid, $cid);
				$check_cart_stmt->execute();
				$cart_result = $check_cart_stmt->get_result();
	
				if ($cart_result->num_rows == 0) {
					// Product is not in the cart, insert new item
					$insert_stmt = $conn->prepare("INSERT INTO cart (product_name, product_price, product_image, qty, total_price, ClientID) VALUES (?, ?, ?, ?, ?, ?)");
					$insert_stmt->bind_param('sdssdi', $pname, $pprice, $pimage, $pqty, $total_price, $cid);
					$insert_stmt->execute();
	
					echo '<div class="alert alert-success alert-dismissible mt-2">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Item added to your cart! Remaining stock: ' . $new_stock_qty . '</strong>
						  </div>';
				} else {
					echo '<div class="alert alert-danger alert-dismissible mt-2">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<strong>Item already added to your cart!</strong>
						  </div>';
				}
			} else {
				echo '<div class="alert alert-danger alert-dismissible mt-2">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Not enough items in stock!</strong>
					  </div>';
			}
		} else {
			echo '<div class="alert alert-danger alert-dismissible mt-2">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error: Could not retrieve product details from the database.</strong>
				  </div>';
		}
	}


	// Get no.of items available in the cart table
	if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
		$stmt = $conn->prepare("SELECT * FROM cart where ClientID = '$cid'");
	    $stmt->execute();
	    $stmt->store_result();
	    $rows = $stmt->num_rows;

	  echo $rows;
	}

	// Remove single items from cart
	if (isset($_GET['remove'])) {
		$id = $_GET['remove'];
	
		// First, fetch the existing item details from the cart
		$stmt = $conn->prepare("SELECT product_name, qty FROM cart WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($itemData = $result->fetch_assoc()) {
			// Fetch the current stock from the products table
			$stmt = $conn->prepare("SELECT id, product_qty FROM product WHERE product_name = ?");
			$stmt->bind_param("s", $itemData['product_name']);
			$stmt->execute();
			$result = $stmt->get_result();
			$productData = $result->fetch_assoc();
	
			if ($productData) {
				// Update the product table by adding back the quantity
				$newQty = $productData['product_qty'] + $itemData['qty'];
				$stmt = $conn->prepare("UPDATE product SET product_qty = ? WHERE id = ?");
				$stmt->bind_param("is", $newQty, $productData['id']);
				$stmt->execute();
	
				// Now remove the item from the cart
				$stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
				$stmt->bind_param("i", $id);
				$stmt->execute();
	
				$_SESSION['showAlert'] = 'block';
				$_SESSION['message'] = 'Item removed from the cart and stock updated!';
				header('location:cart.php');
			} else {
				echo "Failed to fetch product data.";
			}
		} else {
			echo "Failed to fetch cart data.";
		}
		}
  
	  // Set total price of the product in the cart table
	  if (isset($_POST['qty'])) {
		$qty = $_POST['qty'];
		$pid = $_POST['pid'];
		$pprice = $_POST['pprice'];
  
		$tprice = $qty * $pprice;
  
		$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
		$stmt->bind_param('isd',$qty,$tprice,$pid);
		$stmt->execute();
	  }
	  // Checkout and save customer info in the orders table
	if (isset($_POST['action']) && isset($_POST['action']) == 'order') {
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$products = $_POST['products'];
		$grand_total = $_POST['grand_total'];
		$clientID = $_SESSION['id']; 
		$receiptDate = $_POST['date'];
  
		$data = '';
		$currentDate = date('Y-m-d');
		if(!empty($products)){
			$stmt = $conn->prepare('INSERT INTO orders (name,email,phone,products,amount_paid,ClientID,receiptDate,order_date)VALUES(?,?,?,?,?,?,?,?)');
			$stmt->bind_param('ssssssss',$name,$email,$phone,$products,$grand_total,$clientID,$receiptDate,$currentDate);
				$stmt->execute();
				$stmt2 = $conn->prepare("DELETE FROM cart WHERE ClientID = '$cid'");
				$stmt2->execute();
				
				$data .= '<div class="text-center">
				<h1 class="display-4 mt-2 text-danger">Thank You!</h1>
				<h2 class="text-success">Your Order Placed Successfully!</h2>
				<h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
				<h4>Your Name : ' . $name ." ". $surname .'</h4>
				<h4>Your E-mail : ' . $email . '</h4>
				<h4>Your Phone : ' . $phone . '</h4>
				<h4>Total Amount Paid : ' . number_format($grand_total,2) . '</h4>
				<h4>Last day reception : '.$receiptDate.'</h4>
				</div>';
	  echo $data;
		}
		else {
			echo '<div class="alert alert-danger alert-dismissible mt-2">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong>There are no products in your cart</strong>
							</div>';
			echo '<script>
							setTimeout(function() {
								window.location.href = "../cart/index.php"; // Change this to the desired redirection target
							}, 2500); // Redirect after 2500 milliseconds (2.5 seconds)
						  </script>';			
		}
	}
	

if (isset($_GET['clear'])) {
    
    // First, fetch all items to be cleared from the cart
    $stmt = $conn->prepare("SELECT product_name, qty FROM cart WHERE ClientID = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    $allCleared = true;

    while ($itemData = $result->fetch_assoc()) {
        // Fetch the current stock for each item from the products table
        $stmt2 = $conn->prepare("SELECT id, product_qty FROM product WHERE product_name = ?");
        $stmt2->bind_param("s", $itemData['product_name']);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $productData = $result2->fetch_assoc();

        if ($productData) {
            // Update the product table by adding back the quantity
            $newQty = $productData['product_qty'] + $itemData['qty'];
            $stmt3 = $conn->prepare("UPDATE product SET product_qty = ? WHERE id = ?");
            $stmt3->bind_param("ii", $newQty, $productData['id']);
            $stmt3->execute();
        } else {
            $allCleared = false;  // If any item fails to update, flag it
            echo "Failed to update stock for product: " . $itemData['product_name'] . "<br>";
        }
    }

    if ($allCleared) {
        // If all items were successfully returned to stock, clear the cart
        $stmt4 = $conn->prepare("DELETE FROM cart WHERE ClientID = ?");
        $stmt4->bind_param("i", $cid);
        $stmt4->execute();

        $_SESSION['showAlert'] = 'block';
        $_SESSION['message'] = 'All items removed from the cart!';
        header('location:cart.php');
    } else {
        echo '<div class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Failed to return some products to stock.</strong>
              </div>';
    }
}
?>