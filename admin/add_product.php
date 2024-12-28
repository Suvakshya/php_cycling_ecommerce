<?php
  //  include('../server/connection.php');
  //  if(!isset($_SESSION['admin_logged_in'])){
  //   header("location: login.php");
  //   exit();
  //  }
?>

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
  <title>Add product</title>
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
    text-decoration: none;
  }

  .edit-btn:hover {
    background-color: rgb(2, 140, 182);
  }

  .delete-btn {
    width: 100px;
    font-size: 1rem;
    font-weight: 100;
    outline: none;
    border: none;
    background-color: rgb(235, 78, 78);
    color: aliceblue;
    padding: 7px 10px;
    border-radius: 8px;
    text-transform: uppercase;
    text-decoration: none;
    cursor: pointer;
    transition: 0.4s ease;
  }

  .delete-btn:hover {
    background-color: rgb(180, 7, 7);
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
            <a class="nav-link" href="./index.php">Order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./account.php">account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./products.php">All product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="./add_product.php">Add new product</a>
          </li>
          <!-- Updated logout link -->
          <li class="nav-item">
            <a class="nav-link" href="logout.php?logout=1">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

 <!------------------ add product ---------------------->
  <section class="checkout-section">
        <div class="checkout-container">
            <h2 class="checkout-text">Add Product <hr style="width: 70px; border: 2px solid #ff7f50;"></h2>
        </div>
        
        <div class=".checkout-form-container">
       <form id="register-form" enctype="multipart/form-data" method="POST" action="create_product.php" >

        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
        </div>
        <div class="form-group">
          <label for="">Description</label>
          <input type="text" class="form-control" id="checkout-email" name="description" placeholder="Description" required />
        </div>
        <div class="form-group">
          <label for="">Price</label>
          <input type="text" class="form-control" id="checkout-phone" name="price" placeholder="Price " required />
        </div>

        <div class="form-group">
          <label for="">Special Offer/sale</label>
          <input type="text" class="form-control" id="checkout-city" name="offer" placeholder="Sale % " required />
        </div>

        <div class="form-group">
          <label for="">Category</label>
          <select name="category" id="">
            <option value="CX">Cross Country</option>
            <option value="Trail">Trail</option>
            <option value="DownHill">Down Hill</option>
            <option value="Accessory">Accessory</option>
          </select>
        </div>

        <div class="form-group">
          <label for="">Color</label>
          <input type="text" class="form-control" id="checkout-city" name="color" placeholder="Color" required />
        </div>

        <div class="form-group">
          <label for="">Special Offer/sale</label>
          <input type="text" class="form-control" id="checkout-city" name="offer" placeholder="Sale % " required />
        </div>

        <div class="form-group">
          <label for="">Image</label>
          <input type="file" class="form-control" id="checkout-city" name="image1" placeholder="Image1 " required />
        </div>
         
        <div class="form-group">
          <input type="submit" class="btn" id="checkout-btn" name="create_product" value="Create" />
        </div>
      </form>
    </div>

    </section>

  </body>
</html>
