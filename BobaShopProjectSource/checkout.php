<?php
include('navbar.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Sample cart items
if (!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = [
        ['base' => 'Green Tea', 'size' => 'Medium', 'topping' => 'Tapioca', 'price' => 6.00],
        ['base' => 'Matcha', 'size' => 'Large', 'topping' => 'Pudding', 'price' => 7.50]
    ];
}

// Calculate the total price of the items
$total_price = 0;
foreach ($_SESSION['cart_items'] as $item) {
    $total_price += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Checkout</h2>

        <h4>Order Summary</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Base</th>
                    <th>Size</th>
                    <th>Topping</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart_items'] as $item): ?>
                    <tr>
                        <td><?php echo $item['base']; ?></td>
                        <td><?php echo $item['size']; ?></td>
                        <td><?php echo $item['topping']; ?></td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><strong>$<?php echo number_format($total_price, 2); ?></strong></td>
                </tr>
            </tbody>
        </table>

        <h4>Billing Information</h4>
        <form action="confirmation.php" method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" pattern="\d{10}" placeholder="(###) ###-####"required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com"required>
            </div>
            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" pattern="\d{16}" placeholder="#### #### #### ####"required>
            </div>
            <div class="mb-3">
                <label for="card_type" class="form-label">Card Type</label>
                <select class="form-select" id="card_type" name="card_type" required>
                    <option value="mastercard">MasterCard</option>
                    <option value="visa">Visa</option>
                    <option value="amex">American Express</option>
                    <option value="discover">Discover</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State</label>
                <input type="text" class="form-control" id="state" name="state" required>
            </div>
            <div class="mb-3">
                <label for="zip" class="form-label">Zip Code</label>
                <input type="text" class="form-control" id="zip" name="zip" pattern="\d{5}" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Order</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
