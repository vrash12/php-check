<!DOCTYPE html>
<html>
<head>
    <title>Main Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Jewelry Inventory System</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">Products</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="add_product.php">Add Product</a>
                        <a class="dropdown-item" href="delete_product.php">Delete Product</a>
                        <a class="dropdown-item" href="update_product.php">Show All Products</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</body>
</html>
