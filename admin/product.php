
<?php

 include('../server/connection.php');

  $stmt = $conn->prepare("SELECT * FROM products ");
  $stmt->execute();
  $products = $stmt->get_result();//[]

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin products</title>
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
  /* text-transform: uppercase; */
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
            <a class="nav-link" href="./index.php">dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./order.php">order</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./product.php">All product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./product.php">Add new product</a>
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
   <section style="margin:100px;" id="orders-container">
     <div  style="margin-top:100px;" class="orders-cart-container">
       <h2 class="orders-cart-font-weight-bolde" id="order-title">Admin Products</h2>
     </div>
     <table class="orders-cart-table">
       <tr>
         <th>Product Id</th>
         <th>Product Image</th>
         <th>Product Name</th>
         <th>Product Price</th>
         <th>Product Offer</th>
         <th>Product Category</th>
         <th>Product Color</th>
         <th>Edit</th>
         <th>Delete</th>
       </tr>
 
 
       <?php
       while($row = $products->fetch_assoc()){
       ?>
 
 
       <tr>
         <td>
           <div class="orders-product-info">
             <!-- <img src="assets/imgs/cycle1.jpeg" alt=""> -->
             <div>
               <p class="orders-p"><?php echo $row['product_id'];?></p>
             </div>
           </div>
         </td>

         <td>
            <div class="orders-product-info">
              <img src="../assets/imgs/<?php echo $row['product_image']; ?>" alt="">
            </div>
          </td>
         
         <td>
           <span><?php echo $row['product_name'];?></span>
         </td>
         <td>
           <span><?php echo $row['product_price'];?></span>
         </td>
         <td>
           <span><?php echo $row['product_special_offer'];?></span>
         </td>
         <td>
           <span><?php echo $row['product_category'];?></span>
         </td>
         <td>
           <span><?php echo $row['product_color'];?></span>
         </td>
         <td>
         <a class="edit-btn" href="edit_product.php?product_id=<?php echo $row['product_id']; ?>">edit</a>

         </td>
         <td>
         <form method="GET" action="">
             <input class="delete-btn"  name="order_details_btn" type="submit" value="delete"/>
           </form>
         </td>
 
       </tr>
 
       <?php }?>
 
     </table>
   </section>
 

</body>
</html>
