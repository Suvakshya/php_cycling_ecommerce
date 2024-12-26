<?php
session_start();

if(isset($_POST['order_confirmation_btn'])){
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Confirmation</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="../assets/css/index.css">
  
</head>
<body>

  <!--------------- Navbar -------------------->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="../assets/imgs/logoo.png" class="logo" alt="Logo" />
      <span class="navbar-toggler-icon"></span>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="../shop.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="../blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="../contact.php">Contact Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!--------------- checkout -------------------->
  <section class="checkout-section">
    <div class="checkout-container">
      <h2 class="checkout-text">Order Confirmation</h2>
      <hr class="checkout-hr">
    </div>

    <div class="checkout-payment-form-container" style="text-align: center; padding: 20px;">
      <h3>Thank you for your payment!</h3>
      <p>Your order has been successfully paid.</p>
      <form action="order_confirmation.php" method="POST">
        <input class="chekout-btn" type="submit" name="order_confirmation_btn" value="proceed">
      </form>
      
    </div>
  </section>

  <!--------------- Footer -------------------->
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
      <div class="footer-item footer-social">
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
      <p>&copy; 2025 Peakpeadlers. All Rights Reserved.</p>
    </div>
  </footer>
</body>
</html>
