<?php

 include('connection.php');


//  $stmt = $conn->prepare("SELECT * FROM products Where product_category='coats' LIMIT 4");
 $stmt = $conn->prepare("SELECT * FROM products Where product_category='Accessory' LIMIT 4");

 $stmt->execute();

 $coats_products = $stmt->get_result();//[]

?>
