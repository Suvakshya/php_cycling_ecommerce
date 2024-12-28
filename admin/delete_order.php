<?php
include('../server/connection.php');

// Check if order_id is provided
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Prepare SQL statement to delete order
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id =?");
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        header("Location: index.php?deleted_successfully=Order deleted successfully");
    } else {
        header("Location: index.php?deleted_failure=Error occurred, try again");
    }
} else {
    header("Location: index.php?deleted_failure=Order ID is missing");
}
