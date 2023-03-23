<?php
require_once('db_connection.php');

if(isset($_POST['edit_product']) && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    $itemName = $_POST['item_name'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];
    $buyingPrice = $_POST['buying_price'];
    $sellingPrice = $_POST['selling_price'];

    // Update the product in the database
    $sql = "UPDATE products SET item_name='$itemName', weight='$weight', quantity='$quantity', buying_price='$buyingPrice', selling_price='$sellingPrice' WHERE id=$productId'";
    if ($conn->query($sql) === TRUE) {
    echo "Product updated successfully";
    } else {
    echo "Error updating product: " . $conn->error;
    }
    $conn->close();
}
?>
