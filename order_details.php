<?php
include('server/connection.php');

// Check if the order details button and order ID are set
if (isset($_GET['order_details_btn']) && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'];

    // Fetch order details
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    // Calculate total order price
    $order_total_price = calculateTotalOrderPrice($order_details);
} else {
    header('Location: account.php');
    exit;
}

// Helper function to calculate total price
function calculateTotalOrderPrice($order_details) {
    $total = 0;
    foreach ($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += ($product_price * $product_quantity);
    }
    return $total;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" 
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/index.css">
  <style>
    .pay-btn {
      width: 100px;
      font-size: 1rem;
      font-weight: 100;
      outline: none;
      border: none;
      background-color: #ff7f50;
      color: aliceblue;
      padding: 7px 10px;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.4s ease;
      margin: 20px;
    }
    .pay-btn:hover {
      background-color: rgb(170, 62, 40);
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="assets/imgs/logoo.png" class="logo" alt="Logo">
      <span class="navbar-toggler-icon"></span>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="./shop.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="./blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="./contact.php">Contact Us</a></li>
          <li class="nav-item icons">
            <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a class="nav-link" href="./account.php"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Order Details -->
  <section style="margin:100px; margin-top:150px" id="orders-container">
    <div style="margin-top:100px;" class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde" id="order-title">Order Details</h2>
    </div>
    <table class="orders-cart-table">
      <tr>
        <th style="padding-left: 55px;">Product</th>
        <th>Price</th>
        <th style="text-align: right; padding-right: 50px;">Quantity</th>
      </tr>

      <?php foreach ($order_details as $row) { ?>
        <tr>
          <td>
            <div class="orders-product-info">
              <img src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
              <div><p class="orders-p"><?php echo $row['product_name']; ?></p></div>
            </div>
          </td>
          <td><span><?php echo $row['product_price']; ?></span></td>
          <td style="text-align: right; padding-right:80px"><span><?php echo $row['product_quantity']; ?></span></td>
        </tr>
      <?php } ?>
    </table>

    <!-- Payment Button -->
    <?php if ($order_status === "not paid") { ?>
      <form style="float:right;" method="POST" action="server/payment.php">
        <input type="hidden" name="order_total_price" value="<?php echo htmlspecialchars($order_total_price); ?>">
        <input type="hidden" name="order_status" value="<?php echo htmlspecialchars($order_status); ?>">
        <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_id); ?>">
        <input type="submit" name="order_payy_btn" class="pay-btn" value="Pay now">
      </form>
    <?php } ?>
  </section>

  <!-- Footer -->
  <footer class="footer-container">
    <div class="footer-content">
      <div class="footer-logo">
        <img src="assets/imgs/flogo.png" alt="Logo">
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
      <p>&copy; 2025 Peakpedalers. All Rights Reserved.</p>
    </div>
  </footer>
</body>
</html>
