<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
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
            <a class="nav-link" href="./index.html">Home</a>
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

  <!------------------------ Home ---------------------->
  <section id="home">
    <div class="container">
      <h5>New Arrivals</h5>
      <h1><span>Best Prices</span> This Season</h1>
      <p>Peak peadlers offers the best prodcts for the most affordiable prices</p>
      <button onclick="window.location.href='shop.html'">Shop now</button>
    </div>
  </section>

  <!----------------------- Brand ------------------------>
  <h1 class="brand-h1">Brands</h1>
  <section id="brand" class="brand-container">
    <div class="brand-row">
      <img class="brand-img" src=" assets/imgs/brand1.jpg" alt="">
      <img class="brand-img" src=" assets/imgs/brand2.png" alt="">
      <img class="brand-img" src=" assets/imgs/brand3.png" alt="">
      <img class="brand-img" src=" assets/imgs/brand4.png" alt="">
    </div>
  </section>

  <!-------------------------- New ------------------------>
  <section id="new" class="new-section">
    <h1 class="new-h1">Category</h1>
    <div class="new-row">

      <!-- One -->
      <div class="new-one">
        <img class="new-img" src="assets/imgs/1.jpg" alt="Shoes">
        <div class="new-details">
          <h2>Down Hill</h2>
          <button onclick="window.location.href='shop.html'">Shop now</button>
        </div>
      </div>

      <!-- Two -->
      <div class="new-one">
        <img class="new-img" src="assets/imgs/trail.webp" alt="Shoes">
        <div class="new-details">
          <h2>Trail</h2>
          <button onclick="window.location.href='shop.html'">Shop now</button>
        </div>
      </div>

      <!-- Three -->
      <div class="new-one">
        <img class="new-img" src="assets/imgs/crosscountry.jpg" alt="Shoes">
        <div class="new-details">
          <h2>Cross country</h2>
          <button onclick="window.location.href='shop.html'">Shop now</button>
        </div>
      </div>

    </div>
  </section>

  <!--------------------- Featured ------------------------------>
  <section id="featured">
    <div class="featured-container">
      <h1 class="featured-h1">Our Featured</h1>
      <hr>
      <p>Here you can check out our new featured products</p>
    </div>
    <div class="product-container">

      <?php include('server/get_featured_products.php'); ?>



      <?php while($row = $featured_products->fetch_assoc()){?>

      <div class="product text-center">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image']?>" >
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="p-name">
          <?php echo $row['product_name']?>
        </h5>
        <h4 class="p-price">$
          <?php echo $row['product_price']?>
        </h4>
        <button class="buy-btn">Buy now</button>
      </div>

      <?php }?>

    </div>
  </section>

  <!---------------------- banner ----------------------->
  <section id="banner" class="my-5 py-5">
    <div class="banner-container">
      <h4>Mid season's sale</h4>
      <h1 class="banner-h1">Canyon neuron<br>Up to 30% OFF</h1>
      <button class="banner-button" onclick="window.location.href='shop.html'">Shop now</button>
    </div>
  </section>

  <!------------------Clothes---------------------->
  <section id="clothes">
    <div class="clothes-container">
      <h1 class="clothes-h1">Dresses & outfits</h1>
      <hr>
      <p>Here you can check out our outfits</p>
    </div>
    <div class="cproduct-container">

    <?php include('server/get_coats.php'); ?>

    <?php while($row = $coats_products->fetch_assoc()) { ?>


      <div class="cproduct ">
        <img class="img-fluid mb-3" src="assets/imgs/<?php echo $row['product_image'];?>" alt="">
        <div class="star">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <h5 class="cp-name"><?php echo $row['product_name'];?></h5>
        <h4 class="cp-price"><?php echo $row['product_price'];?></h4>
        <a href="<?php echo "single_product.php?product_id=". $row['product_id']?>"><button class="buy-btn">Buy now</button></a>
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