<?php
$name_err = $quantity_err = $price_err = ""; 
$p = '';
// Include the database connection
include "../php/config.php";  

// Fetch cart items that have been in the cart for more than one hour
$currentTime = time();
$oneHourAgo = $currentTime - 3600;  // Current time minus one hour (3600 seconds)
$oneHourAgoDateTime = date('Y-m-d H:i:s', $oneHourAgo);

$stmt = $conn->prepare("SELECT * FROM cart WHERE timer <= ?");
$stmt->bind_param('s', $oneHourAgoDateTime);
$stmt->execute();
$expiredCartItems = $stmt->get_result();

while ($cartItem = $expiredCartItems->fetch_assoc()) {
    $product_name = $cartItem['product_name'];
    $pid = $cartItem['id'];
    $p = $pid;//en polo xreiazetai
    $qtyInCart = $cartItem['qty'];

    // Retrieve current stock quantity from the product table
    $stmt = $conn->prepare("SELECT product_qty FROM product WHERE product_name = ?");
    $stmt->bind_param('s', $product_name);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($product = $result->fetch_assoc()) {
        $currentStockQty = $product['product_qty'];
        $newStockQty = $currentStockQty + $qtyInCart;

        // Update product stock quantity
        $stmtUpdate = $conn->prepare("UPDATE product SET product_qty = ? WHERE product_name = ?");
        $stmtUpdate->bind_param('is', $newStockQty, $product_name);
        $stmtUpdate->execute();
    }

    // Delete the expired cart item
    $stmtDelete = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $stmtDelete->bind_param('i', $cartItem['id']);
    $stmtDelete->execute();
}

// Checking if any errors occurred during database operations
if ($conn->error) {
    die("Database error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Shopping Cart System</title>
  

   <!-- CSS here -->
   <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

	<!-- CSS here -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">
	<link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
	<link rel="stylesheet" href="../assets/css/themify-icons.css">
	<link rel="stylesheet" href="../assets/css/slick.css">
	<link rel="stylesheet" href="../assets/css/nice-select.css">
	<link rel="stylesheet" href="../assets/css/style.css">
    
    
    
    <!-- Style CSS -->
    
  
</head>

<body>
<div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="../assets/img/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
<header>
    <?php include "../html/header.php"?>
</header>

<div class="slider-area2">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2 pt-70 text-center">
                                <h2>Orders</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
  <!-- Navbar start -->
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar"> -->
  <?php
  echo "alo " . $p;
    // $stmt = $conn->prepare("SELECT product_qty FROM product WHERE id = ?");
		// $stmt->bind_param('i', $pid);
		// $stmt->execute();
		// $result = $stmt->get_result();
		// if ($row = $result->fetch_assoc()) {
		// 	$current_stock_qty = $row['product_qty'];
			
		// 	$currentTime = time();
		// 	$addedTime = $currentTime + 90;  // Current time plus 90 seconds
		// 	$addedDateTime = date('Y-m-d H:i:s', $addedTime);


    // // Fetch product quantity from 'product' table
    // $stmt2 = $conn->prepare("SELECT product_qty FROM product WHERE product_name = ?");//thelo na vro to qty 
    // $stmt2->bind_param('s', $name);
    // $stmt2->execute();
    // $result2 = $stmt2->get_result();
    // $row1 = $result2->fetch_assoc();
    // $current_stock_qty = $row1['product_qty'] ?? 0;

    // // Fetch cart items that need to be updated or removed
    // $stmt = $conn->prepare("SELECT * FROM cart WHERE timer <= ?");//filtraro gia na vro poia tha prepei na figoun
    // $stmt->bind_param('s', $addedDateTime);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $updatedQty = $row['qty'] + $current_stock_qty;
    //         $stmtUpdate = $conn->prepare("UPDATE product SET product_price = ?, product_qty = ? WHERE product_name = ?");//ta stelno ston product
    //         $stmtUpdate->bind_param("dis", $row['product_price'], $updatedQty, $row['product_name']);
    //         $stmtUpdate->execute();

    //         $stmtDelete = $conn->prepare("DELETE FROM cart WHERE id = ?");//ta diagrafo ekei pou einai 
    //         $stmtDelete->bind_param('i', $row['id']);
    //         $stmtDelete->execute();
    //     }
    // }

    // // Display remaining cart items
    // $stmt1 = $conn->prepare("SELECT * FROM cart WHERE timer >= ?");
    // $stmt1->bind_param('s', $addedDateTime);
    // $stmt1->execute();
    // $result1 = $stmt1->get_result();
    // if ($result1->num_rows > 0) {
    //     echo '<h2 class="mt-5">Products List</h2>
    //           <table class="table table-bordered">
    //             <thead>
    //                 <tr>
    //                     <th>ID</th>
    //                     <th>Name</th>
    //                     <th>Price</th>
    //                     <th>Quantity</th>
    //                     <th>Timer</th>
                        
    //                 </tr>
    //             </thead>
    //             <tbody>';
    //     while ($row = $result1->fetch_assoc()) {
    //         echo "<tr>
    //                 <td>{$row['id']}</td>
    //                 <td>{$row['product_name']}</td>
    //                 <td>{$row['product_price']}</td>
    //                 <td>{$row['qty']}</td>
    //                 <td>" . ($row['timer'] ? $row['timer'] : 'N/A') . "</td>
                     
    //               </tr>";
    //     }
    //     echo '</tbody>
    //           </table>';
    // } else {
    //     echo "No products found that are expiring after {$addedDateTime}.";
    // }

		// }
  
  ?>
  
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-left: 10px; margin-right:20px;">
  Show Orders
</button>
  
<?php include 'showOrders.php'; ?>
  
  <?php 
  // Check if the user is an admin
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true  && $_SESSION['typeOfUser'] == '1'){
    // Display the button for admins
    echo '<a href="indexcode.php"> <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">
        Edit Products
      </button>
      </a>';
        
       
    }
    ?>
 
  </div>
  
  
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="order.php">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- Navbar end -->

  <!-- Displaying Products Start -->
  <div class="container">
    <div id="message"></div>
    <div class="row mt-2 pb-3">
      <?php
  			$stmt = $conn->prepare('SELECT * FROM product');//edo einai ta dedomena pou exei to product ta pairnei gia na ta valei meta
  			$stmt->execute();
  			$result = $stmt->get_result();
  			while ($row = $result->fetch_assoc()):
  		?>
      <div class="col-sm-6 col-md-4 col-lg-3 mb-2"><!-- dislpay -->
        <div class="card-deck"><!-- kamnei diplay tis times mesa sto index gia ta products -->
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['product_image'] ?>" class="card-img-top" height="250">
            <form action= <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="form-submit" method="post">
            <div class="card-body p-1">
              <h3 class="card-title text-center text-info"><?= $row['product_name'] ?></h3>
              <h4 class="card-text text-center text-danger"><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2) ?></h4>

              <div class="row p-2">
                  <div class="col-md-6 py-1 pl-4">
                    <b>Quantity : </b>
                  </div>
                  <div class="col-md-6">
                  <input type="number" name="qty" class="form-control pqty" value="1" min="1" max="<?= $row['product_qty'] ?>" onchange="updateHiddenInput(this.value)">
                    </div>
                </div>
            </div>
            <div class="card-footer p-1">
              
                <div class="row p-2 ">
                <span class="invalid-feedback">
                  <div class="col-md-6 py-1 pl-4">
                    
                  </div>
                    <div class="col-md-6">
                      <input type="number" name="qty" class="form-control pqty" value = "1"  min="1" max="<?= $row['product_qty'] ?>" onchange="updateHiddenInput(this.value)">
                    </div>
                </div>
                <!-- pairnei ta dedomena kai ta vazei mesa  -->
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                  <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                  <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                  <input type="hidden" id="hiddenQuantity" class="pqty" name="hiddenQuantity">
                  <input type="hidden" class="sqty" value="<?= $row['product_qty'] ?>">
                  <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                  <input type="hidden" class="ClientID" value="<?php $_SESSION['id']?>">
                  <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                    cart</button>
                
                  <script>
                      function updateHiddenInput(value) {
                      document.getElementById('hiddenQuantity').value = value;
                      console.log(value);
                      }
                    </script> 
                    <?php
                   if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Assuming your form has an input field for quantity with the name 'product_qty'
                    $quantity = isset($_POST['qty']) ? intval($_POST['qty']) : 0; // Default to 0 if not set
                    $_SESSION['quantity'] = $quantity; // Store the quantity in a session variable
                    
                
                    
                    exit;
                }
                  
                  ?>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- Displaying Products End -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Send product details in the server
    $(".addItemBtn").click(function(e) {
      e.preventDefault();
      var $form = $(this).closest(".form-submit");
      var pid = $form.find(".pid").val();
      var pname = $form.find(".pname").val();
      var pprice = $form.find(".pprice").val();
      var pimage = $form.find(".pimage").val();

      var sqty = $form.find(".sqty").val();
      var pqty = $form.find(".pqty").val();
      

      $.ajax({
        url: 'action.php',
        method: 'post',
        data: {
          pid: pid,
          pname: pname,
          pprice: pprice,
          pqty: pqty,
          pimage: pimage,   
          sqty:sqty,
          
          
        },
        success: function(response) {
          $("#message").html(response);
          //window.scrollTo(0, 0);
          load_cart_item_number();
        }
      });
    });

    // Load total no.of items added in the cart and display in the navbar
    load_cart_item_number();

    function load_cart_item_number() {
      $.ajax({
        url: 'action.php',
        method: 'get',
        data: {
          cartItem: "cart_item"
        },
        success: function(response) {
          $("#cart-item").html(response);
        }
      });
    }
  });
  </script>
  
  <?php include "../html/footer.php"?>
  
  <script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>
    
    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>
    
    
</body>

</html> 