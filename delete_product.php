<?php
require_once('db_connection.php');

if(isset($_POST['delete_product']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = $productId";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }

    $conn->close();
}
?>
