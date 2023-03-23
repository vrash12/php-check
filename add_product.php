<?php

require_once('db_connection.php');

if (isset($_POST['add_product'])) {
    $item_name = $conn->real_escape_string($_POST['item_name']);
    $weight = $conn->real_escape_string($_POST['weight']);
    $quantity = $conn->real_escape_string($_POST['quantity']);
    $buying_price = $conn->real_escape_string($_POST['buying_price']);
    $selling_price = $conn->real_escape_string($_POST['selling_price']);

    $sql = "INSERT INTO products (item_name, weight, quantity, buying_price, selling_price)
            VALUES ('$item_name', '$weight', '$quantity', '$buying_price', '$selling_price')";

    if ($conn->query($sql) === TRUE) {
        // Refresh the page to show the new product
        header("Location: products.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$conn->close();

?>