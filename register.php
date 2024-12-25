<?php
session_start();
include('server/connection.php');

if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit; 
}


if (isset($_POST['register'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // If password doesn't match
    if ($password !== $confirmPassword) {
        header('location: register.php?error=Passwords do not match');
        exit;
    }
    // If password is less than 6 characters
    else if (strlen($password) < 6) {
        header('location: register.php?error=Password must be at least 6 characters');
        exit;
    }

    // Check if a user with this email already exists
    $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    // If a user is registered with this email, redirect to register page with error
    if ($num_rows != 0) {
        header('location: register.php?error=User with this email already exists');
        exit;
    } else {
        // Create a new user
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Secure password hash
        // $stmt->bind_param('sss', $name, $email, $hashedPassword);
        $stmt->bind_param('sss', $name, $email, md5($password));

        // If account was created successfully, redirect to account page
        if ($stmt->execute()) {
            $user_id= $stmt->insert_id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_name'] = $name;
            $_SESSION['logged_in'] = true;
            header('location: account.php?register_success=You registered successfully');
            exit;
        } else {
            header('location: register.php?error=Could not create an account at the moment');
            exit;
        }
    }
  exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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


  <!--------------------- Register ----------------------->
  <section class="register-section">
    <div class="register-container ">
      <h2 class="register-text">Register</h2>
      <hr class="register-hr">
    </div>
    <div class=".register-form-container">
      <form action="" id="register-form" method="POST" action="register.php">
      <p style="color:red;"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>


        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label for="">Email</label>
          <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required />
        </div>
        <div class="form-group">
          <label for="">Password</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="Password "
            required />
        </div>
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
            placeholder="Confirm Password " required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="Register-btn" name="register" value="Register" />
        </div>
        <div class="form-group">
          <a id="login-url" href="login.php" class="btn">Already have an account ? login</a>
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