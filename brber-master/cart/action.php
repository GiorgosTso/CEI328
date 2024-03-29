<?php
	session_start();
	require '../php/config.php';
	$cid = $_SESSION['id'];
	
	// Add products into the cart table
	if (isset($_POST['pid'])) {// edo pianei ola ta dedomena tou pou ton pinaka 
		  $pid = $_POST['pid'];
		  $pname = $_POST['pname'];
		
		  $pprice = $_POST['pprice'];
		  $pimage = $_POST['pimage'];
	
		  $pqty = $_POST['pqty'];
		  $stock_qty = $_POST['sqty'];
		  
		  
			if($stock_qty >= $pqty) {
				$total_price = $pprice * $pqty;//apla pollaplasiazei to me to quantity
				
				$stock = $pqty - $stock_qty;
				$stmt3 = $conn->prepare("UPDATE product SET product_qty = ? WHERE id = ?");
				$stmt3->bind_param('ii',$stock,$pid);
				$stmt3->execute();

				$stmt = $conn->prepare('SELECT id FROM cart WHERE id=?');//proetoimazei ta dedomena pou enna piasei apo tin vasi
				$stmt->bind_param('s',$pid);//kamnei ta bind $pcode
				$stmt->execute();//ektela
				$res = $stmt->get_result();//pairnei ta dedomena
				$r = $res->fetch_assoc();//pairnei tin grammi apo to SQL kai ta vazei mesa sto associative array
				$code = $r['pid'] ?? '';//apla vazei ta pano sto $code
			  
					if (!$code) {
					  $query = $conn->prepare('INSERT INTO cart (product_name,product_price,product_image,qty,total_price,ClientID) VALUES (?,?,?,?,?,?)');
					  $query->bind_param('sissii',$pname,$pprice,$pimage,$pqty,$total_price,$cid);//kamnei ta bind genika xrisimopoieitai gia na mporoume na sindeoume tin SQL me tin php
					  $query->execute();
			  
					  echo '<div class="alert alert-success alert-dismissible mt-2">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>Item added to your cart!</strong>
									  </div>';//apla kamnei diplay ena alert otan einai sosto
					} 
					else {
					  echo '<div class="alert alert-danger alert-dismissible mt-2">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<strong>Item already added to your cart!</strong>
									  </div>';//apla kamnei display ena alert otan einai lathos
					}
	        }
	        else {
				echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Not enough Items in the stock!</strong>
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

	  $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	  $stmt->bind_param('i',$id);
	  $stmt->execute();

	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'Item removed from the cart!';
	  header('location:cart.php');
	}

	// Remove all items at once from cart
	if (isset($_GET['clear'])) {
	  $stmt = $conn->prepare("DELETE FROM cart WHERE ClientID = '$cid'");
	  $stmt->execute();
	  $_SESSION['showAlert'] = 'block';
	  $_SESSION['message'] = 'All Item removed from the cart!';
	  header('location:cart.php');
	}

	// Set total price of the product in the cart table
	if (isset($_POST['qty'])) {
	  $qty = $_POST['qty'];
	  $pid = $_POST['pid'];
	  $pprice = $_POST['pprice'];

	  $tprice = $qty * $pprice;

	  $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	  $stmt->bind_param('isi',$qty,$tprice,$pid);
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
		
			
				
		        
		
				$stmt = $conn->prepare('INSERT INTO orders (name,email,phone,products,amount_paid,ClientID,receiptDate)VALUES(?,?,?,?,?,?,?)');
				$stmt->bind_param('sssssss',$name,$email,$phone,$products,$grand_total,$clientID,$receiptDate);
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
	


?>