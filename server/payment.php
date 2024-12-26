<?php
session_start();
include('connection.php');

// Check if the payment button is clicked
if (isset($_POST['order_pay_btn'])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price'];
    $order_id = $_POST['order_id'];

    // Validate input data
    if (!empty($order_id) && $order_status === "not paid") {
        $new_status = "payed";

        // Update the order status in the database
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $new_status, $order_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Order successfully paid!";
            header("Location: ../order_confirmation.php");
            exit;
        } else {
            echo "Error updating order status: " . $conn->error;
        }
    } else {
        echo "Invalid order data.";
    }
} else {
    echo "Invalid request.";
}
?>  in this code wihout hampering the layout <?php
session_start();

if(isset($_POST['order_pay_btn'])){
  $order_status = $_POST['order_status'];
  $order_total_price = $_POST['order_total_price'];

  $_SESSION['total'] = $order_total_price;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="../assets/css/index.css">

</head>

<body>

  <!------------------ Navbar ---------------------->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="../assets/imgs/logoo.png" class="logo" alt="Logo" />
      <!-- <button class="navbar-toggler" id="navbar-toggler"> -->
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../contact.php">Contact Us</a>
          </li>
          <li class="nav-item icons">
            <a class="nav-link" href="../cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a class="nav-link" href="../account.php"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!----------------- Payment -------------------->

  <section class="checkout-section">
    <div class="checkout-container ">
      <h2 class="checkout-text">Payment</h2>
      <hr class="checkout-hr">
    </div>
    <div class=".checkout-payment-form-container" 
    style="display: flex;
           justify-content: center;
           align-items: center;
           flex-direction: column;
           padding:10px">
      <p><?php if(isset($_GET['order_status'])){echo $_GET['order_status'];}?></p>
      <p>Total payment: <span style="color: coral; text:bold">$<?php if(isset($_SESSION['total'])){ echo $_SESSION['total'];}?></span></p>
      <input class="chekout-btn" type="submit" value="Pay Now">
    </div>
  </section>




  <!--------------- Footer --------------------->
  <footer class="footer-container">
    <div class="footer-content">
      <div class=" footer-logo">
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