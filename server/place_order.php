<?php
session_start();

include('connection.php');
 
if(!isset($_SESSION['logged_in'])){
  header('location:../login.php?error=Please login to place an order');
  exit;
}else{
  if(isset($_POST['place_order'])){

    // 1. Get user info and store it in the database
    $name = $_POST['name'];  // Capture the name from the form
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d ');

    // Insert the order information into the 'orders' table (including the name)
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, user_name, order_date) 
                           VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('isiissss', $order_cost, $order_status, $user_id, $phone, $city, $address, $name, $order_date);
    $stmt->execute();

    // 2. Issue new order and store order info in the database
    $order_id = $stmt->insert_id;

    // 3. Insert each cart item into the 'order_items' table
    foreach($_SESSION['cart'] as $key => $value) {
      $product = $value;  
      $product_id = $product['product_id'];
      $product_name = $product['product_name'];
      $product_image = $product['product_image'];
      $product_price = $product['product_price'];
      $product_quantity = $product['product_quantity'];

      // 4. Store each single item in the 'order_items' table in the database
      $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) 
                               VALUES (?,?,?,?,?,?,?,?)");
      $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
      $stmt1->execute();
    }

    // 5. Inform the user that the order has been placed successfully
    // You can remove the cart items here if required (optional)
    // unset($_SESSION['cart']);

    // 6. Redirect to the orders section in the account page
    header('Location: ../account.php#orders-container');
    exit;
  }
}
?>
