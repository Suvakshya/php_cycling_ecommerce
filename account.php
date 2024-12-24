<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="./assets/css/index.css">


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
            <a class="nav-link" href="./shop.html">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./blog.html">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./contact.html">Contact Us</a>
          </li>
          <li class="nav-item icons">
            <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a class="nav-link" href="./account.html"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!--------------------- Account ----------------------->
  <section class="account-section">
    <div class="account-container">
      <div>
        <h3 class="account-h3">Account info</h3>
        <div class="account-info">
          <p>Name <span>John</span></p>
          <p>Email <span>John@email.com</span></p>
          <p><a href="" id="order-btn">Your orders</a></p>
          <p><a href="" id="logout-btn">Logout</a></p>
        </div>
      </div>
      <div class="account-form-container">
        <form action="" id="account-form">
          <h3>Change Password</h3>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="account-password" name="password" placeholder="Password"
              required>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="account-password-confirm" name="confirmpassword"
              placeholder="Confirm Password" required>
          </div>
          <div class="form-group">
            <input type="submit" value="Change Password" class="btn" id="change-pass-btn">
          </div>
        </form>
      </div>
    </div>
  </section>


  <!-------------------- orders ------------------------->
  <section id="orders-container">
    <div class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde">Your Orders</h2>
    </div>
    <table class="orders-cart-table">
      <tr>
        <th>Product</th>
        <th>Date</th>
      </tr>
      <tr>

        <td>
          <div class="orders-product-info">
            <img src="assets/imgs/cycle1.jpeg" alt="">
            <div>
              <p class="orders-p">cycle</p>
            </div>
          </div>
        </td>

        <td>
          <span>2036-5-8</span>
        </td>

      </tr>
    </table>
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
          <li><a href="#">Men</a></li>
          <li><a href="#">Women</a></li>
          <li><a href="#">Girls</a></li>
          <li><a href="#">New Arrival</a></li>
          <li><a href="#">Clothes</a></li>
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