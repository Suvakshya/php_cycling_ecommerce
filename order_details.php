
<?php
include('server/connection.php');

if(isset($_GET['order_details_btn']) && isset($_GET['order_id'])){

  $order_id = $_GET['order_id'];

  $order_status= $_GET['order_status'];

  $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ? ");

  $stmt->bind_param('i',$order_id);

  $stmt->execute();

  $order_details = $stmt->get_result();
}else{
  header('location:account.php');
  exit;
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

  <style>
    .pay-btn{
  width: 100px;
  font-size: 1rem;
  font-weight: 100;
  outline: none;
  border: none;
  background-color: #ff7f50;
  color: aliceblue;
  padding: 7px 10px;
  border-radius: 8px;
  /* text-transform: uppercase; */
  cursor: pointer;
  transition: 0.4s ease;
  margin:20px
}

.pay-btn:hover {
  background-color: rgb(170, 62, 40);
}
  </style>


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

   <!------------------ Order details ---------------------->

  <section style="margin:100px; margin-top:150px" id="orders-container">
    <div  style="margin-top:100px;" class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde" id="order-title">Order Details</h2>
    </div>
    <table class="orders-cart-table" >
      <tr>
        <th style="padding-left: 55px;">Product</th>
        <th>Price</th>
        <th style=" text-align: right; padding-right: 50px;">Quantity</th>
      </tr>


      <?php
      while($row = $order_details->fetch_assoc()){
      ?>


      <tr >
        <td>
          <div class="orders-product-info">
            <img src="assets/imgs/<?php echo $row['product_image']?>" alt="">
            <div>
              <p class="orders-p"><?php echo $row['product_name']?></p>
            </div>
          </div>
        </td>

        <td>
          <span><?php echo $row['product_price']?></span>
        </td>

        <td style=" text-align: right ; padding-right:80px">
          <span><?php echo $row['product_quantity'];?></span>
        </td>


  

      </tr>

      <?php }?>


    </table>

    <?php
    if($order_status === "not paid"){?>
    <form style="float:right;">
      <input type="submit" class="pay-btn" value="Pay now"/>
    </form>

    <?php }?>
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