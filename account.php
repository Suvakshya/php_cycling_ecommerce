<?php
session_start();
include('server/connection.php');
if(!isset($_SESSION['logged_in'])){
  header('location:login.php');
  exit; 
}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location:login.php');
    exit;
  }
}

if(isset($_POST['change_password'])){

  $password =  $_POST['password'];
  $confirmPassword =  $_POST['confirmPassword'];
  $user_email =  $_SESSION['user_email'];

  // If password doesn't match
  if ($password !== $confirmPassword) {
    header('location: account.php?error=Passwords do not match');
    exit;
}
// If password is less than 6 characters
else if (strlen($password) < 6) {
    header('location: account.php?error=Password must be at least 6 characters');
    exit;
} 
//if no eror 
else{
$stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email =?");
$stmt->bind_param("ss",md5($password),$user_email);

if($stmt->execute()){
  header('location:account.php?message=password has been updated successfully');
}else{
  header('location:account.php?message=password could not be updated');
}
}
}

//---------------------get orders----------------------------------//

if(isset($_SESSION['logged_in'])){

  $user_id =  $_SESSION['user_id'];

  $stmt = $conn->prepare("SELECT * FROM orders Where user_id=? LIMIT 4");

  $stmt->bind_param('i',$user_id);

  $stmt->execute();
 
  $orders = $stmt->get_result();//[]
}
?>


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


  <!--------------------- Account ----------------------->
  <section class="account-section">
    <div class="account-container">
      <div>
      <p class="text-center" style="color:green;margin-left: 100px;"><?php if(isset($_GET['register_success'])){echo $_GET['register_success'];}?></p>
      <p class="text-center" style="color:green;margin-left: 100px;"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];}?></p>
        <h3 class="account-h3">Account info</h3>
        <div class="account-info">
          <p>Name: <span><?php echo $_SESSION['user_name'];?></span></p>
          <p>Email: <span><?php echo $_SESSION['user_email'];?></span></p>
          <p><a href="#orders-container" id="order-btn">Your orders</a></p>
          <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
        </div>
      </div>
      <div class="account-form-container">
      <p class="text-center" style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>
      <p class="text-center" style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];}?></p>
        <form  id="account-form" method="POST" action="account.php">
          <h3>Change Password</h3>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="account-password" name="password" placeholder="Password"
              required>
          </div>
          <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword"
              placeholder="Confirm Password" required>
          </div>
          <div class="form-group">
            <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
          </div>
        </form>
      </div>
    </div>
  </section>


  <!-------------------- orders ------------------------->
  <section style="margin:100px;" id="orders-container">
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <hr>
    <div  style="margin-top:100px;" class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde" id="order-title">Your Orders</h2>
    </div>
    <table class="orders-cart-table">
      <tr>
        <th>Order id</th>
        <th>Order cost</th>
        <th>Order status</th>
        <th>Order Date</th>
        <th>Order details</th>
      </tr>


      <?php
      while($row = $orders->fetch_assoc()){
      ?>


      <tr>

        <td>
          <div class="orders-product-info">
            <!-- <img src="assets/imgs/cycle1.jpeg" alt=""> -->
            <div>
              <p class="orders-p"><?php echo $row['order_id'];?></p>
            </div>
          </div>
        </td>

        <td>
          <span><?php echo $row['order_cost'];?></span>
        </td>

        <td>
          <span><?php echo $row['order_status'];?></span>
        </td>

        <td>
          <span><?php echo $row['order_date'];?></span>
        </td>

        <td>
          <form method="GET" action="order_details.php">
            <input type="hidden" value="<?php echo $row['order_status'];?>" name="order_status"/>
            <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id"/>
            <input class="ordertd-btn" name="order_details_btn" type="submit" value="details"/>
          </form>
        </td>

      </tr>

      <?php }?>

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