<?php
include('../server/connection.php');

// if (!isset($_SESSION['admin_logged_in'])) {
//     header("location: login.php");
//     exit();
// }

// Fetch all users
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="../assets/css/index.css">
</head>


<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="../assets/imgs/logoo.png" class="logo" alt="Logo" />
      <span class="navbar-toggler-icon"></span>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./account.php">Accounts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./products.php">All product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./add_product.php">Add new product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php?logout=1">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>





  <section style=" margin:50px;margin-top:150px;" id="orders-container">
    <div style="margin-top:100px;" class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde" id="order-title">User Account
        <hr style="width: 70px; border: 2px solid #ff7f50;"></h2>
      
      
    </div>
    <table class=" orders-cart-table">
        <tr>
          <th>User Id</th>
          <th>User Name</th>
          <th>User Email</th>
        </tr>


        <?php
        while ($user = $users->fetch_assoc()) { 
      ?>



        <tr>

          <td>
            <span>
              <?php echo $user['user_id']; ?>
            </span>
          </td>

          <td>
            <span>
              <?php echo $user['user_name']; ?>
            </span>
          </td>

          <td>
            <span>
              <?php echo $user['user_email']; ?>
            </span>
          </td>

        </tr>

        <?php }?>

        </table>
  </section>

</body>

</html>