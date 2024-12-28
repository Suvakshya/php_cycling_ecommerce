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
  <title>Admin dashboard</title>
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
            <a class="nav-link" href="./account.php">Accounts</a>
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

  <!-------------------- orders ------------------------->
  <section style="margin:100px"  id="orders-container">
    <div class="orders-cart-container">
      <h2 class="orders-cart-font-weight-bolde" id="order-title"style="margin-top:120px">Your Orders  <hr style="width: 70px; border: 2px solid #ff7f50;"></h2>

      <?php if(isset($_GET['edit_success_message'])){?>
      <p style="color:green">
        <?php echo $_GET['edit_success_message'];?>
      </p>
      <?php }?>

      <?php if(isset($_GET['edit_failure_message'])){?>
      <p style="color:red">
        <?php echo $_GET['edit_failure_message'];?>
      </p>
      <?php }?>

      <?php if(isset($_GET['deleted_successfully'])){?>
      <p style="color:green">
        <?php echo $_GET['deleted_successfully'];?>
      </p>
      <?php }?>

      <?php if(isset($_GET['deleted_failure'])){?>
      <p style="color:red">
        <?php echo $_GET['deleted_failure'];?>
      </p>
      <?php }?>

    </div>
    <table class="orders-cart-table">
      <tr>
        <th>Order Id</th>
        <!-- <th>Login User Id</th> -->
        <th>User name</th>
        <th>Order Status</th>
        <th>Order Cost</th>
        <th>Order Date</th>
        <th>User Phone</th>
        <th>User Address</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>


      <?php
       while($row = $orders->fetch_assoc()){
       ?>


      <tr>
        <td>
          <div class="orders-product-info">
            <!-- <img src="assets/imgs/cycle1.jpeg" alt=""> -->
            <div>
              <p class="orders-p">
                <?php echo $row['order_id'];?>
              </p>
            </div>
          </div>
        </td>

        <!-- <td>
          <span>
            <?php echo $row['user_id'];?>
          </span>
        </td> -->

        <td>
          <span>
            <?php echo $row['user_name'];?>
          </span>
        </td>

        <td>
          <span>
            <?php echo $row['order_status'];?>
          </span>
        </td>

        <td>
          <span>
            <?php echo $row['order_cost'];?>
          </span>
        </td>

        <td>
          <span>
            <?php echo $row['order_date'];?>
          </span>
        </td>
        <td>
          <span>
            <?php echo $row['user_phone'];?>
          </span>
        </td>
        <td>
          <span>
            <?php echo $row['user_address'];?>
          </span>
        </td>
        <td>
          <a class="edit-btn" href="edit_order.php?order_id=<?php echo $row['order_id'];?>">edit</a>
        </td>
        <td>
          <a class="delete-btn" href="delete_order.php?order_id=<?php echo $row['order_id'];?>">delete</a>
        </td>
       

      </tr>

      <?php }?>

    </table>
  </section>


</body>

</html>