<?php
session_start();
	require '../php/config.php';
  $name = $_SESSION['name'];
  $email = $_SESSION['email'];
	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="author" content="Sahil Kumar">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Checkout</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
</head>

<body>
<div id="error-message" class="alert alert-danger" style="display: none; position: fixed; top: 0; left: 0; width: 100%; text-align: center; z-index: 3;"></div>
  <nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <a class="navbar-brand" href="order.php"><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Mobile Store</a>
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" href="order.php"><i class="fas fa-mobile-alt mr-2"></i>Products</a>
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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 px-4 pb-4" id="order">
      <h4 class="text-center text-info p-2">Complete your order and check your data!</h4>
        <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
          <h5><b>Total Amount Payable : </b><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2) ?></h5>
        </div>
        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <div class="form-group">
          <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name'];?>" placeholder="Enter the Name" required>
          </div>
          <div class="form-group">
          <input type="text" name="surname" class="form-control" value="<?php echo $_SESSION['surname'];?>" placeholder="Enter the Surname" required>
          </div>
          <div class="form-group">
          <input type="email" name="email" class="form-control" value="<?php echo $_SESSION['email'];?>" placeholder="Enter the email" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" value="<?php echo $_SESSION['phone'];?>" placeholder="Enter Phone" required>
          </div>
            <h6 class="text-center lead">Select Day of Reception</h6>
          <div class="form-group">
            <input type="date" id="date" name="date" class="form-control" placeholder="Enter the date" required style="cursor :pointer;">
          </div>
          
          <script>
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date();
        const yyyy = today.getFullYear();
        let mm = today.getMonth() + 1; // getMonth() is zero-based
        let dd = today.getDate();

        // Format today's date as yyyy-mm-dd
        const formattedToday = `${yyyy}-${mm.toString().padStart(2, '0')}-${dd.toString().padStart(2, '0')}`;

        // Calculate one month from today
        let nextMonth = new Date(today);
        nextMonth.setMonth(today.getMonth() + 1); // Adding one month
        nextMonth.setDate(Math.min(dd, new Date(nextMonth.getFullYear(), nextMonth.getMonth() + 1, 0).getDate())); // Adjust day number if necessary

        const nextMonthYYYY = nextMonth.getFullYear();
        let nextMonthMM = nextMonth.getMonth() + 1; // Adjust month number for formatting
        let nextMonthDD = nextMonth.getDate();

        // Format next month's date as yyyy-mm-dd
        const formattedNextMonth = `${nextMonthYYYY}-${nextMonthMM.toString().padStart(2, '0')}-${nextMonthDD.toString().padStart(2, '0')}`;

        // Set min and max attributes
        document.getElementById('date').setAttribute('min', formattedToday);
        document.getElementById('date').setAttribute('max', formattedNextMonth);
    });
</script>
          <div class="form-group">
            <input type="submit" name="submit"  value="Place Order" class="btn btn-danger btn-block">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

  <script type="text/javascript">
  $(document).ready(function() {

    // Sending Form data to the server
    $("#placeOrder").submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: 'action.php',
        method: 'post',
        data: $('form').serialize() + "&action=order",
        success: function(response) {
          $("#order").html(response);
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
  
  document.addEventListener('DOMContentLoaded', function() {
      const datePicker = document.getElementById('date');
      const errorMessage = document.getElementById('error-message');
      
      datePicker.addEventListener('change', function(e) {
        const selectedDate = new Date(this.value);
        const day = selectedDate.getDay();
        // Sunday = 0, Thursday = 4
        if (day === 0 || day === 4) {
          errorMessage.style.display = 'block';
          errorMessage.textContent = 'Sundays and Thursdays are not available for delivery. Please select another day.';
          this.value = ''; // Clear the selected date
          setTimeout(function() {
        errorMessage.style.display = 'none';
      }, 3000);
        } else {
          errorMessage.style.display = 'none'; // Hide the error message when the date is valid
        }
      });
    });
  </script>
</body>

</html>