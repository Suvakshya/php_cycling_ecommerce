<?php
session_start();
include('connection.php'); // Ensure your database connection is included

// Handle the case when the user comes from 'order_detail.php'
if (isset($_POST['order_pay_btn'])) {
    // Form submitted from order_detail.php
    $order_status = $_POST['order_status'];  // Current order status (not paid)
    $order_total_price = $_POST['order_total_price'];  // Total price for the order
    $order_id = $_POST['order_id'];  // Order ID from the form (hidden input)
    
    // Set the total in the session for display
    $_SESSION['total'] = $order_total_price;

    // Update order status to "paid" in the database
    if ($order_status === 'not paid') {
        $new_status = 'paid'; // Assign 'paid' to a variable
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param('si', $new_status, $order_id); // Pass the variable instead of the direct string
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = 'Payment successful! Order status updated to "paid".';
            unset($_SESSION['cart']);
        } else {
            $_SESSION['message'] = 'Error updating order status.';
        }
    }
}

// Handle the case when the user comes from 'place_order.php' (using GET)
if (isset($_GET['order_id']) && isset($_GET['order_status'])) {
    // Get the order ID and status from the GET parameters
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];

    // You might want to calculate the total price from the database if it's not set
    if (!isset($_SESSION['total'])) {
        $stmt = $conn->prepare("SELECT order_cost FROM orders WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $stmt->bind_result($order_cost);
        $stmt->fetch();
        $_SESSION['total'] = $order_cost;  // Store the total in the session
    }
    
    // Update order status to "paid" in the database (if it's not already paid)
    // if ($order_status === 'not paid') {
    //     $new_status = 'paid';
    //     $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    //     $stmt->bind_param('si', $new_status, $order_id);
    //     $stmt->execute();

    //     if ($stmt->affected_rows > 0) {
    //         $_SESSION['message'] = 'Payment successful! Order status updated to "paid".';
    //     } else {
    //         $_SESSION['message'] = 'Error updating order status.';
    //     }
    // }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
  <nav class="navbar">
    <div class="navbar-container">
      <img src="../assets/imgs/logoo.png" class="logo" alt="Logo" />
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="../shop.php">Shop</a></li>
        <li class="nav-item"><a class="nav-link" href="../blog.php">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="../contact.php">Contact Us</a></li>
        <li class="nav-item icons">
          <a class="nav-link" href="../cart.php"><i class="fas fa-shopping-bag"></i></a>
          <a class="nav-link" href="../account.php"><i class="fas fa-user"></i></a>
        </li>
      </ul>
    </div>
  </nav>

  <section class="checkout-section">
    <div class="checkout-container">
      <h2 class="checkout-text">Payment</h2>
      <hr class="checkout-hr">
    </div>
    <div class="checkout-payment-form-container" style="text-align: center; padding: 10px;">
      <p><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : ''; ?></p>
      <p>Total payment: <span style="color: coral; font-weight: bold;">$<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0.00'; ?></span></p>
      <form method="POST" action="../index.php">
        <input type="hidden" name="order_status" value="paid">  <!-- Set status to 'paid' here -->
        <input type="hidden" name="order_total_price" value="<?php echo $_SESSION['total']; ?>">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"> <!-- Send order ID -->
        <input class="chekout-btn" type="submit" value="Proceed">
      </form>
    </div>
  </section>

  <footer class="footer-container">
    <div class="footer-content">
      <div class="footer-logo">
        <img src="../assets/imgs/flogo.png" alt="Logo">
        <p>We provide the best products for the most affordable price</p>
      </div>
      <div class="footer-featured">
        <h5>Featured</h5>
        <ul>
          <li><a href="#">Cross Country MTB</a></li>
          <li><a href="#">Down Hill MTB</a></li>
          <li><a href="#">Trail MTB</a></li>
          <li><a href="#">New Arrival</a></li>
          <li><a href="#">MTB Accessory</a></li>
        </ul>
      </div>
      <div class="footer-contact">
        <h5>Contact Us</h5>
        <div>
          <h6>Address</h6>
          <p>1234 Street Name, City</p>
          <h6>Phone</h6>
          <p>98765766888</p>
          <h6>Email</h6>
          <p>info@gmail.com</p>
        </div>
      </div>
      <div class="footer-social">
        <h5>Follow Us</h5>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>
    </div>
    <hr>
    <div class="footer-rights">
      <p>&copy; 2025 Peakpedalers. All Rights Reserved.</p>
    </div>
  </footer>
</body>
</html>
