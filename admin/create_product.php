<?php
include('../server/connection.php');

if (isset($_POST['create_product'])) {
    // Retrieve form data
    $product_name = $_POST['name'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_special_offer = $_POST['offer'];
    $product_category = $_POST['category'];
    $product_color = $_POST['color'];

    // Handle the image upload
    $image1 = $_FILES['image1']['tmp_name'];
    $file_name = $_FILES['image1']['name'];

    // Define the image name and location
    $image_name1 = $product_name . "1.jpeg";

    // Check if an image is uploaded and move it to the desired location
    if (!empty($image1)) {
        if (!move_uploaded_file($image1, "../assets/imgs/" . $image_name1)) {
            die('Error uploading file.');
        }
    } else {
        // Handle case where no image is uploaded (optional)
        $image_name1 = ''; // You can set a default image or leave it empty
    }

    // Prepare SQL query to insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_category, product_description, product_price, product_special_offer, product_color, product_image) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");

    // Check if prepare failed
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);  // Output MySQL error
    }

    // Bind parameters to the query
    $stmt->bind_param("sssdsss", $product_name, $product_category, $product_description, $product_price, $product_special_offer, $product_color, $image_name1);

    // Execute the query and check if the insertion was successful
    if ($stmt->execute()) {
        // Redirect with a success message
        header("Location: products.php?edit_success_message=Product%20added%20successfully");
    } else {
        // Handle error and display failure message
        header("Location: products.php?edit_failure_message=Failed%20to%20add%20product");
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
