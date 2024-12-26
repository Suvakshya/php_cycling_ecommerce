<?php
session_start();

if(!isset($_SESSION['logged_in'])){
  header('location:../login.php?error=Please login to visit your cart');
  exit;
}

if (isset($_POST['add_to_cart'])) {

    // if user lay product cart ma added gare sakyo vanay 
    if (isset($_SESSION['cart'])) {

        $product_array_ids = array_column($_SESSION['cart'], "product_id"); // [1,2,3,4]
        // adding product to cart if not exgist in the cart
        if (!in_array($_POST['product_id'], $product_array_ids)) {
            $product_array = array( 
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity'],
            );

            $_SESSION['cart'][$_POST['product_id']] = $product_array;
            // if product already cart ma xa vaya sending message aani redirect to homepage
        } else {
            echo '<script>alert("Product was already added to cart");</script>';
            // echo '<script>window.location="index.php";</script>';
        }

    // if user lay pahelo product add gardai xa vaya yo logic
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity'],
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }

}  

//calculate total
// calculateTotalCart();

//remove product from cart
else if(isset($_POST['remove_product'])){
  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);
  calculateTotalCart();
}
else if(isset($_POST['edit_quantity'])){
  $product_id= $_POST['product_id'];
  $product_quantity= $_POST['product_quantity'];
  $product_array= $_SESSION['cart'][$product_id];
  $product_array['product_quantity'] = $product_quantity;
  $_SESSION['cart'][$product_id]=$product_array;
  calculateTotalCart();
}else {
    // header("location:index.php");
}

function calculateTotalCart(){
  $total=0;
  foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total = $total + ($price * $quantity);
  }
  $_SESSION['total']= $total;
}
calculateTotalCart();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
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

  <!---------------------- Cart ----------------------->
  <section class="cart-container ">
    
      <h2 class="cart-font-weight-bolde">Your Cart</h2>
    
    <table class="cart-table">
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Subtotal</th>
      </tr>

      <?php foreach($_SESSION['cart'] as $key => $value){?>
      <tr>
        <td>
          <div class="cart-product-info">
            <img src="assets/imgs/<?php echo $value['product_image'];?>" alt="">
            <div>
              <p><?php echo $value['product_name'];?></p>
              <small><span>$</span><?php echo $value['product_price'];?></small>
              <br>
              <form method="POST" action="cart.php"  >
                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
                <input type="submit" name="remove_product" class="remove-btn" value="Remove"></input>
              </form>
              
            </div>
          </div>
        </td>
        <td>
          
          <form method="POST" action="cart.php">
            <input  type="hidden" name="product_id" value="<?php echo $value['product_id'];?>">
            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>">
            <input  type="submit" class="edit-btn" value="edit" name="edit_quantity">
          </form>
        </td>
        <td>
          <span>$</span>
          <span class="card-product-price"><?php echo $value['product_quantity'] * $value['product_price']?></span>
        </td>
      </tr>

      <?php }?>
    </table>

    <div class="cart-total">
      <table>
        <tr>
          <td>Total </td>
          <td>$<?php echo $_SESSION['total']?></td>
        </tr>
      </table>
    </div>

    <div>
    <form method="POST" action="checkout.php">
      <input type="submit" class=" chekout-btn" value="Checkout"  name="checkout" />
      </form>
      
      
    </div>

  </section>

  <!------------------- Footer ----------------------->
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