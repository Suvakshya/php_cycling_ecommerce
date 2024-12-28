<?php
include('../server/connection.php');

// Fetch order data based on order_id
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param('i', $order_id); 
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc(); // Fetch order data
} else if (isset($_POST['edit_btn'])) {
    // If the form is submitted, process the update
    $order_id = $_POST['order_id'];
    $user_name = $_POST['user_name'];  
    $user_phone = $_POST['user_phone'];  
    $user_city = $_POST['user_city'];  
    $user_address = $_POST['user_address'];  
    $order_status = $_POST['order_status'];  

    $stmt = $conn->prepare("UPDATE orders SET user_name = ?, user_phone = ?, user_city = ?, user_address = ?, order_status = ? WHERE order_id = ?");
    $stmt->bind_param("sssssi", $user_name, $user_phone, $user_city, $user_address, $order_status, $order_id);

    if ($stmt->execute()) {
        header("location: index.php?edit_success_message=Order has been updated successfully");
    } else {
        header("location: index.php?edit_failure_message=Error occurred, try again");
    }
} else {
    header('Location: order.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
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
                        <a class="nav-link"  href="./add_product.php">Add new product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php?logout=1">Log Out</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="checkout-section">
        <div class="checkout-container">
            <h2 class="checkout-text">Edit Order  <hr style="width: 70px; border: 2px solid #ff7f50;"></h2>
        </div>
        <div class="checkout-form-container">
            <form id="register-form" method="POST" action="edit_order.php">
                <div class="form-group">
                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>" />
                    <label for="user_name">User Name</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="<?php echo $order['user_name']; ?>" placeholder="User Name" required />
                </div>

                <div class="form-group">
                    <label for="user_phone">Phone</label>
                    <input type="text" class="form-control" id="user_phone" name="user_phone" value="<?php echo $order['user_phone']; ?>" placeholder="Phone" required />
                </div>

                <div class="form-group">
                    <label for="user_city">City</label>
                    <input type="text" class="form-control" id="user_city" name="user_city" value="<?php echo $order['user_city']; ?>" placeholder="City" required />
                </div>

                <div class="form-group">
                    <label for="user_address">Address</label>
                    <input type="text" class="form-control" id="user_address" name="user_address" value="<?php echo $order['user_address']; ?>" placeholder="Address" required />
                </div>

                <div class="form-group">
                    <label for="order_status">Order Status</label>
                    <select class="form-control" name="order_status" id="order_status">
                        <option value="not paid" <?php if ($order['order_status'] == 'not paid') echo 'selected'; ?>>Not Paid</option>
                        <option value="paid" <?php if ($order['order_status'] == 'paid') echo 'selected'; ?>>Paid</option>
                        <option value="shipped" <?php if ($order['order_status'] == 'shipped') echo 'selected'; ?>>Shipped</option>
                        <option value="delivered" <?php if ($order['order_status'] == 'delivered') echo 'selected'; ?>>Delivered</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="submit" class="edit-btn" id="checkout-btn" name="edit_btn" value="Edit" />
                </div>
            </form>
        </div>
    </section>
</body>

</html>
