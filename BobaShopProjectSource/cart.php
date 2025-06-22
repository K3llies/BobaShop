<?php
include('navbar.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Handle removing an item from the cart
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    unset($_SESSION['cart'][$index]);
    // Re-index the cart array to maintain consecutive keys
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Calculate total price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Boba Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cart-table th, .cart-table td {
            text-align: center;
        }
        .cart-table td button {
            color: red;
        }
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>

    <!-- Cart Section -->
    <section class="cart-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Your Cart</h2>

            <?php if (empty($_SESSION['cart'])): ?>
                <div class="alert alert-info text-center">Your cart is empty.</div>
            <?php else: ?>
                <table class="table table-bordered cart-table">
                    <thead>
                        <tr>
                            <th>Base</th>
                            <th>Topping</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['base']); ?></td>
                                <td><?php echo htmlspecialchars($item['topping']); ?></td>
                                <td><?php echo htmlspecialchars($item['size']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                                <td><a href="cart.php?remove=<?php echo $index; ?>" class="btn btn-danger">Remove</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Total Price -->
                <div class="d-flex justify-content-end">
                    <h4>Total Price: $<?php echo number_format($totalPrice, 2); ?></h4>
                </div>

                <!-- Checkout Button -->
                <div class="text-center mt-4">
                    <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

