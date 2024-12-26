<?php
include('server/connection.php');

// Set default category  values
$category = $_POST['category'] ?? ''; 

// Set the number of products per page
$products_per_page = 6;

// Get the current page from URL, default to page 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($page - 1) * $products_per_page;

// Create a basic SQL query to fetch products
$query = "SELECT * FROM products WHERE 1";

// Add filters if specified
if ($category) {
    $query .= " AND product_category = '$category'";
}

// Add LIMIT and OFFSET for pagination
$query .= " LIMIT $products_per_page OFFSET $offset";

// Execute the query
$products = $conn->query($query);

// Get the total number of products for pagination
$total_products_query = "SELECT COUNT(*) AS total FROM products WHERE 1";
if ($category) {
    $total_products_query .= " AND product_category = '$category'";
}
$total_result = $conn->query($total_products_query);
$total_row = $total_result->fetch_assoc();
$total_products = $total_row['total'];

// Calculate total pages
$total_pages = ceil($total_products / $products_per_page);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shop</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
  <link rel="stylesheet" href="./assets/css/index.css">
  
  <style>
    body {
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      
    } 

    .main-container {
      display: flex;
      width: 100%;
      /* margin-top:150px; */
      height: 600px;
    }


    .search-section {
      width: 20%;
      Fixed width;
      padding-left: 40px;
      margin-top: 230px;
      margin-left: 100px;
      height: 250px;
      background-color: #f8f9fa;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 80px;
      left: 0;
      bottom: 80px;
      overflow-y: auto;
      box-sizing: border-box;
    }

    #featured {
      margin-left: 20%;
      margin-right:0px;
      padding: 20px;
      overflow-y: auto;
      height: calc(100vh - 80px);
    }

    .page-item.active .page-link {
      background-color: #ff7f50;
      color: white;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="navbar-container">
      <img src="assets/imgs/logoo.png" class="logo" alt="Logo" />
      <span class="navbar-toggler-icon"></span>
      <div class="navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="./shop.php">Shop</a></li>
          <li class="nav-item"><a class="nav-link" href="./blog.php">Blog</a></li>
          <li class="nav-item"><a class="nav-link" href="./contact.php">Contact Us</a></li>
          <li class="nav-item icons">
            <a class="nav-link" href="./cart.php"><i class="fas fa-shopping-bag"></i></a>
            <a class="nav-link" href="./account.php"><i class="fas fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Main content container -->
  <div class="main-container">
    <!-- Search Section -->
    <section id="search" class="search-section">
      <div>
        <h4 style="color:#ff7f50; margin-bottom: 0;">Search Products</h4>
        <hr style="border:1px solid #ff7f50; margin-top: 1px;">
      </div>
      <form action="shop.php" method="POST">
        <div>
          <p>Category</p>
          <div class="form-check">
            <input class="form-check-input" value="CX" type="radio" name="category" id="category_one" <?php echo
              ($category=='CX' ) ? 'checked' : '' ; ?>>
            <label class="form-check-label" for="category_one">Cross Country</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="Trail" type="radio" name="category" id="category_two" <?php echo
              ($category=='Trail' ) ? 'checked' : '' ; ?>>
            <label class="form-check-label" for="category_two">Trail</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="DownHill" type="radio" name="category" id="category_three" <?php echo
              ($category=='DownHill' ) ? 'checked' : '' ; ?>>
            <label class="form-check-label" for="category_three">Down Hill</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="Accessory" type="radio" name="category" id="category_four" <?php echo
              ($category=='Accessory' ) ? 'checked' : '' ; ?>>
            <label class="form-check-label" for="category_four">Accessory</label>
          </div>
        </div>

        <div style="margin-top:15px" class="form-group my-3 mx-3">
          <button type="submit" name="search" value="search" class="search-submit-btn">Search</button>
        </div>
      </form>
    </section>

    <!-- Featured Section -->
    <section id="featured">
      <div class="featured-container">
        <h1 class="featured-h1 " style="margin-top:50px;">Our Shop</h1>
        <hr>
        <p>Your Perfect Trail Companion Awaits</p>
      </div>

      <div class="product-container">
        <?php while ($row = $products->fetch_assoc()) { ?>
        <div class="product">
          <img class="img-fluid" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="">
          <div class="star">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
          <h5 class="p-name">
            <?php echo $row['product_name']; ?>
          </h5>
          <h4 class="p-price">
            <?php echo $row['product_price']; ?>
          </h4>
          <button class="buy-btn">
            <a style="text-decoration: none; color:white"
              href="single_product.php?product_id=<?php echo $row['product_id']; ?>">Buy now</a>
          </button>
        </div>
        <?php } ?>
      </div>

      <!-- Pagination -->
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>"><a class="page-link"
              href="?page=<?php echo $page - 1; ?>">Previous</a></li>
          <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
          <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>"><a class="page-link"
              href="?page=<?php echo $i; ?>">
              <?php echo $i; ?>
            </a></li>
          <?php } ?>
          <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>"><a class="page-link"
              href="?page=<?php echo $page + 1; ?>">Next</a></li>
        </ul>
      </nav>
    </section>
  </div>

  <!-- Footer -->
  <footer class="footer-container">
    <div class="footer-content">
      <div class="footer-logo">
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
          <p>+1 (234) 567-890</p>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>