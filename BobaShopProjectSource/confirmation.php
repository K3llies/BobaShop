<?php
include('navbar.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Collect form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$card_number = $_POST['card_number'];
$card_type = $_POST['card_type'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];

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
    <title>Order Confirmation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Order Confirmation</h2>

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
        <p><strong>Name:</strong> <?php echo $first_name . ' ' . $last_name; ?></p>
        <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Address:</strong> <?php echo $address; ?></p>
        <p><strong>City:</strong> <?php echo $city; ?></p>
        <p><strong>State:</strong> <?php echo $state; ?></p>
        <p><strong>Zip Code:</strong> <?php echo $zip; ?></p>
        <p><strong>Card Type:</strong> <?php echo ucfirst($card_type); ?></p>
        <p><strong>Card Number:</strong> **** **** **** <?php echo substr($card_number, -4); ?></p>

        <a href="index.php" class="btn btn-success">Return to Home</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
