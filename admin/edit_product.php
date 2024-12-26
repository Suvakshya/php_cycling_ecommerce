
<?php

 include('../server/connection.php');

  $stmt = $conn->prepare("SELECT * FROM orders ");
  $stmt->execute();
  $orders = $stmt->get_result();//[]

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="../assets/css/index.css">
</head>
 
<style>
.edit-btn {
  width: 100px;
  font-size: 1rem;
  font-weight: 100;
  outline: none;
  border: none;
  background-color: rgb(78, 198, 235);
  color: aliceblue;
  padding: 7px 10px;
  border-radius: 8px;
  text-transform: uppercase;
  cursor: pointer;
  transition: 0.4s ease;
}

.edit-btn:hover {
  background-color: rgb(2, 140, 182);
}
</style>

<body>
  <!------------------ Navbar ---------------------->

  <nav class="navbar">
    <div class="navbar-container">
      <img src="../assets/imgs/logoo.png" class="logo" alt="Logo" />
      <span class="navbar-toggler-icon"></span>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="./index.php">dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./order.php">order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./product.php">All product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./product.php">Add new product</a>
          </li>
          <!-- Updated logout link -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php?logout=1">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

    <section class="checkout-section">
    <div class="checkout-container ">
      <h2 class="checkout-text">Check Out</h2>
      <hr class="checkout-hr">
    </div>
    <div class=".checkout-form-container">
      <form id="register-form" method="POST" action="product.php" >

        <div class="form-group">
          <label for="">Title</label>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Titla"  />
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Description" />
        </div>
        <div class="form-group">
          <label for="">Price</label>
          <input type="text" class="form-control" id="checkout-phone" name="phone" placeholder="Price " />
        </div>
        <div class="form-group">
          <label for="">Category</label>
          <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Category"  />
        </div>
        <div class="form-group">
          <label for="">Color</label>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Color"/>
        </div>
        <div class="form-group">
          <label for="">Special Offer/Sale</label>
          <input type="text" class="form-control" id="checkout-address" name="address" placeholder="sale %" />
        </div>
        <div class="form-group">
          <input type="submit" class="edit-btn" id="checkout-btn" name="place_order" value="Edit" />
        </div>
      </form>
    </div>
  </section>

   

</body>
</html>
