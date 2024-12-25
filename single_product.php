<?php

include('server/connection.php');

if(isset($_GET['product_id'])){

  $product_id=$_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $stmt->bind_param("i",$product_id);

  $stmt->execute();
 
  $product = $stmt->get_result();//[]

}else{
  header('location:index.php');//product id xena vaya home page ma redirec huxa
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>single_product</title>
  <!-- Font Awesome link -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
    integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

  <link rel="stylesheet" href="./assets/css/index.css">

</head>

<body>
  <!--------------- Navbar --------------------->
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

  <!------------- single product --------------->

  <section class="single-product">
    <div class="single-product-container">

      <?php while($row= $product->fetch_assoc()){?>

      <div class="single-image-container">
        <img class="single-product-image" src="assets/imgs/<?php echo $row['product_image'] ?>" alt="">
      </div>
      <div class="single-product-details">
        <h6>Men/Shoes</h6>
        <h3 class="single-product-title"><?php echo $row['product_name']?></h3>
        <h2 class="single-product-price">$<?php echo $row['product_price']?></h2>


        <form method="POST" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>"/>
          <input type="hidden" name="product_image" value="<?php echo $row['product_image'] ?>"/>
          <input type="hidden" name="product_name" value="<?php echo $row['product_name'] ?>"/>
          <input type="hidden" name="product_price" value="<?php echo $row['product_price'] ?>"/>

        <div class="single-quantity-container">
          <input type="number" name="product_quantity" value="1" class="single-quantity-input">
        </div>
        <button class="buy-btn" type="submit" name="add_to_cart">Add to Cart</button>
      </form>
      
       
        <h4 class="single-product-description-title">Product Details</h4>
        <span class="single-product-description"><?php echo $row['product_description']?></span>
      </div>

      <?php }?>


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