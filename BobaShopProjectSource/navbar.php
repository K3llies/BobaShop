<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boba Shop Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .navbar {
            background-color: #FFB5FA;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Boba Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Admin Login link -->
                    <li class="nav-item">
                        <a class="nav-link" href="admin_login.php">Admin Login</a>
                    </li>
                    <!-- Menu link -->
                    <li class="nav-item">
                        <a class="nav-link" href="menu.php">Menu</a>
                    </li>
                    <!-- Cart link with dynamic cart item count -->
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">
                            Cart
                            <?php
                            // Display the cart count if there are items in the cart
                            if (isset($_SESSION['cart_count']) && $_SESSION['cart_count'] > 0) {
                                echo '<span class="badge bg-danger">' . $_SESSION['cart_count'] . '</span>';
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
