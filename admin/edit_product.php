<?php
//    include('../server/connection.php');
//    if(!isset($_SESSION['admin_logged_in'])){
//     header("location: login.php");
//     exit();
//    }
?>

<?php
include('../server/connection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $product_id); 
    $stmt->execute();
    $products = $stmt->get_result(); // Fetch the product data
} else if (isset($_POST['edit_btn'])) {
    $product_id = $_POST['product_id'];
    $title = $_POST['title'];  
    $description = $_POST['description'];  
    $price = $_POST['price'];  
    $offer = $_POST['offer'];  
    $color = $_POST['color'];  
    $category = $_POST['category']; 

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_price = ?, product_special_offer = ?, product_color = ?, product_category = ? WHERE product_id = ?");
    $stmt->bind_param("ssssssi", $title, $description, $price, $offer, $color, $category, $product_id);

    if ($stmt->execute()) {
        header("location: products.php?edit_success_message=Product has been updated successfully");
    } else {
        header("location: products.php?edit_failure_message=Error occurred, try again");
    }
} else {
    header('Location: products.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                        <a class="nav-link" href="./products.php">All product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add new product</a>
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
        <div class="checkout-container">
            <h2 class="checkout-text">Edit Product</h2>
            <hr class="checkout-hr">
        </div>
        <div class="checkout-form-container">
            <form id="register-form" method="POST" action="edit_product.php">
                <div class="form-group">
                    <?php foreach ($products as $product) { ?>
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>" />
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="product-name" value="<?php echo $product['product_name']; ?>" name="title" placeholder="Title" />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="product-desc" value="<?php echo $product['product_description']; ?>" name="description" placeholder="Description" />
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="product-price" value="<?php echo $product['product_price']; ?>" name="price" placeholder="Price" />
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control" name="category" id="product-category">
                        <option value="CX" <?php if ($product['product_category'] == 'CX') echo 'selected'; ?>>Cross Country</option>
                        <option value="Trail" <?php if ($product['product_category'] == 'Trail') echo 'selected'; ?>>Trail</option>
                        <option value="DownHill" <?php if ($product['product_category'] == 'DownHill') echo 'selected'; ?>>Down Hill</option>
                        <option value="Accessory" <?php if ($product['product_category'] == 'Accessory') echo 'selected'; ?>>Accessory</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" value="<?php echo $product['product_color']; ?>" id="checkout-color" name="color" placeholder="Color" />
                </div>

                <div class="form-group">
                    <label for="offer">Special Offer/Sale</label>
                    <input type="text" class="form-control" value="<?php echo $product['product_special_offer']; ?>" id="checkout-offer" name="offer" placeholder="Sale %" />
                </div>

                <div class="form-group">
                    <input type="submit" class="edit-btn" id="checkout-btn" name="edit_btn" value="Edit" />
                </div>
                <?php } ?>
            </form>
        </div>
    </section>
</body>

</html>
