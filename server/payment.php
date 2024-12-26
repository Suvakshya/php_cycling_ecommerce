<?php
session_start();

if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];

    // Set the total in the session for display
    $_SESSION['total'] = $order_total_price;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
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
      <form method="POST" action="../order_confirmation.php">
        <input class="chekout-btn" type="submit" value="Pay Now">
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
