
<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in'])){
  header('location:account.php');
  exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email = ? LIMIT 1");

    $stmt->bind_param('s', $email);

    // Execute statement
    if ($stmt->execute()) {
        $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
        $stmt->store_result();

        // Check if email exists and password is correct
        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            // Verify password using password_verify()
            if (password_verify($password, $user_password)) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['logged_in'] = true;

                // Redirect to account page
                header("location: account.php?login_success=logged in successfully");
            } else {
                header("location: login.php?error=Invalid password");
            }
        } else {
            header("location: login.php?error=No account found with that email");
        }
    } else {
        header("location: login.php?error=Something went wrong");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

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


  <!--------------------- login ----------------------->
  <section class="login-section">
    <div class="login-container ">
      <h2 class="login-text">Login</h2>
      <hr class="login-hr">
    </div>
    <div class=".login-form-container">
      <form id="login-form" method="POST" action="login.php">
        <p style="color:red" class="text-center"><?php if(isset($_GET['error'])){echo $_GET['error'];}?></p>

        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="password "
            required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="login-btn"  name="login_btn" value="login" />
        </div>
        <div class="form-group">
          <a id="register-url" href="register.php" class="btn">Don't have an account ? Register</a>
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