<?php
session_start();
if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){
  //if cart is not let user in 
}else{
  //send user to home page
  header('location:index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

  <link rel="stylesheet" href="./assets/css/index.css">

</head>

<body>

  <!------------------ Navbar ---------------------->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="assets/imgs/logoo.png" class="logo" alt="Logo" />
      <!-- <button class="navbar-toggler" id="navbar-toggler"> -->
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.php">Contact Us</a>
          </li>
          <li class="nav-item icons">
            <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a class="nav-link" href="./account.php"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!----------------- checkout -------------------->

  <section class="checkout-section">
    <div class="checkout-container ">
      <h2 class="checkout-text">Check Out</h2>
      <hr class="checkout-hr">
    </div>
    <div class=".checkout-form-container">
      <form id="register-form" method="POST" action="server/place_order.php" >

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label for="">Phone</label>
          <input type="text" class="form-control" id="checkout-phone" name="phone" placeholder="Phone " required />
        </div>
        <div class="form-group">
          <label for="">City</label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City " required />
        </div>
        <div class="form-group">
          <label for="">Address</label>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
        </div>
        <div class="form-group">
          <p>Total amount :<span style="color: #ff7f50; font-weight: bold;">$<?php echo $_SESSION['total']?></span> </p>
          <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order" />
        </div>
      </form>
    </div>
  </section>




  <!--------------- Footer --------------------->
  <footer class="footer-container">
    <div class="footer-content">
      <div class=" footer-logo">
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
      <p>&copy; 2025 Peakpeadlers. All Rights Reserved.</p>
    </div>
  </footer>



</body>

</html>