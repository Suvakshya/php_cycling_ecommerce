<?php
session_start();
include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location:index.php');
  exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email =? LIMIT 1");
    $stmt->bind_param('s', $email);

    // Execute statement
    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();

        // Check if email exists and password is correct
        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            // Compare the entered password with the stored one
            if ($password === $admin_password) {
                // Password is correct, set session variables
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_email'] = $admin_email;
                $_SESSION['admin_logged_in'] = true;

                // Redirect to index page
                header("location: index.php?login_success=logged in successfully");
                exit;
            } else {
                header("location: login.php?error=Invalid password");
                exit;
            }
        } else {
            header("location: login.php?error=No account found with that email");
            exit;
        }
    } else {
        header("location: login.php?error=Something went wrong");
        exit;
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />

  <link rel="stylesheet" href="../assets/css/index.css">
</head>

<body>

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
          <input type="password" class="form-control" id="login-password" name="password" placeholder="password"
            required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="login-btn"  name="login_btn" value="login" />
        </div>
      </form>
    </div>
  </section>


  </body>
</html>