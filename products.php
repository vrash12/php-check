<?php
require_once('db_connection.php');

// Fetch products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addProductModal">Add Product</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Weight</th>
                    <th>Quantity</th>
                    <th>Remaining</th>
                    <th>Total Amount Remaining</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Sold</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td>{$row['weight']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>{$row['remaining']}</td>";
                        echo "<td>{$row['total_amount_remaining']}</td>";
                        echo "<td>{$row['buying_price']}</td>";
                        echo "<td>{$row['selling_price']}</td>";
                        echo "<td>{$row['sold']}</td>";
                        echo "<td>";
                        echo "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editProductModal-{$row['id']}'>Modify</button> ";
                        echo "<button class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteProductModal-{$row['id']}'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No products found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Product Modal -->
<div class="modal" tabindex="-1" role="dialog" id="addProductModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm">
                    <div class="form-group">
                        <label for="item_name">Item Name:</label>
                        <input type="text" id="item_name" name="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="weight">Weight:</label>
                        <input type="number" step="0.01" id="weight" name="weight" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="buying_price">Buying Price:</label>
                        <input type="number" step="0.01" id="buying_price" name="buying_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="selling_price">Selling Price:</label>
                        <input type="number" step="0.01" id="selling_price" name="selling_price" class="form-control" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitAddProduct" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
                    


               <!-- Delete Product Modal -->
       <div class="modal" tabindex="-1" role="dialog" id="deleteProductModal-<?php echo $row['id']; ?>">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the product: <?php echo $row['item_name']; ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="delete_product.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="button" class="btn btn-danger" onclick="deleteProduct(<?php echo $row['id']; ?>)">Delete</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>
<script>
$(document).ready(function() {
    // Add Product
    $('#submitAddProduct').click(function() {
        $.ajax({
            type: 'POST',
            url: 'add_product.php',
            data: $('#addProductForm').serialize()+'&add_product=1',
            success: function(response) {
                $('#addProductModal').modal('hide');
                location.reload();
            }
        });
    });

    // Edit Product
    $('[id^=submitEditProduct-]').click(function() {
        var productId = $(this).attr('id').split('-')[1];
        $.ajax({
            type: 'POST',
            url: 'edit_product.php',
            data: $('#editProductForm-' + productId).serialize()+'&edit_product=1',
            success: function(response) {
                $('#editProductModal-' + productId).modal('hide');
                location.reload();
            }
        });
    });

    // Delete Product
    $('[id^=deleteProduct-]').click(function() {
        var productId = $(this).attr('id').split('-')[1];
        $.ajax({
            type: 'POST',
            url: 'delete_product.php',
            data: { product_id: productId, delete_product: 1 },
            success: function(response) {
                $('#deleteProductModal-' + productId).modal('hide');
                location.reload();
            }
        });
    });
});

</script>


</body>
</html>
