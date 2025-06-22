<?php
include('navbar.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $base = $_POST['base'];
    $topping = $_POST['topping'];
    $size = $_POST['size'];
    $price = $_POST['price'];

    // Add the selected item to the cart
    $_SESSION['cart'][] = [
        'base' => $base,
        'topping' => $topping,
        'size' => $size,
        'price' => $price
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Boba Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .menu-section {
            padding: 50px 0;
        }
        .dropdown-menu {
            min-width: 200px;
        }
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>

    <!-- Menu Section -->
    <section class="menu-section">
        <div class="container">
            <h2 class="text-center">Our Menu</h2>

            <!-- Base Flavors -->
            <form action="menu.php" method="POST">
                <div class="mb-3">
                    <label for="base" class="form-label">Choose Your Base</label>
                    <select class="form-select" id="base" name="base" required>
                        <option value="Green Tea">Green Tea</option>
                        <option value="Black Tea">Black Tea</option>
                        <option value="Jasmine Tea">Jasmine Tea</option>
                        <option value="Strawberry">Strawberry</option>
                        <option value="Lychee">Lychee</option>
                        <option value="Matcha">Matcha</option>
                        <option value="Taro">Taro</option>
                        <option value="Passionfruit">Passionfruit</option>
                        <option value="Brown Sugar">Brown Sugar</option>
                        <option value="Mango">Mango</option>
                    </select>
                </div>

                <!-- Topping Dropdown with Prices -->
                <div class="mb-3">
                    <label for="topping" class="form-label">Choose Your Topping</label>
                    <select class="form-select" id="topping" name="topping" required>
                        <option value="Tapioca" data-price="0.00">Tapioca - $0.00</option>
                        <option value="Mango Popping" data-price="0.55">Mango Popping - $0.55</option>
                        <option value="Strawberry Popping" data-price="0.55">Strawberry Popping - $0.55</option>
                        <option value="Mini Pearls" data-price="0.35">Mini Pearls - $0.35</option>
                        <option value="Lychee Jelly" data-price="0.85">Lychee Jelly - $0.85</option>
                        <option value="Pudding" data-price="0.45">Pudding - $0.45</option>
                    </select>
                </div>

                <!-- Size Dropdown -->
                <div class="mb-3">
                    <label for="size" class="form-label">Choose Your Size</label>
                    <select class="form-select" id="size" name="size" required>
                        <option value="Small" data-price="5.00">Small - $5.00</option>
                        <option value="Medium" data-price="6.00">Medium - $6.00</option>
                        <option value="Large" data-price="7.00">Large - $7.00</option>
                    </select>
                </div>

                <!-- Hidden input for price -->
                <input type="hidden" id="price" name="price" value="5.00">

                <!-- Add to Cart Button -->
                <div class="text-center">
                    <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Update price when size or topping is changed
        const sizeSelect = document.getElementById('size');
        const toppingSelect = document.getElementById('topping');
        const priceInput = document.getElementById('price');

        function updatePrice() {
            const selectedSizeOption = sizeSelect.options[sizeSelect.selectedIndex];
            const selectedToppingOption = toppingSelect.options[toppingSelect.selectedIndex];

            const sizePrice = parseFloat(selectedSizeOption.getAttribute('data-price'));
            const toppingPrice = parseFloat(selectedToppingOption.getAttribute('data-price'));

            const totalPrice = sizePrice + toppingPrice;
            priceInput.value = totalPrice.toFixed(2);
        }

        // Add event listeners to update the price when either size or topping is changed
        sizeSelect.addEventListener('change', updatePrice);
        toppingSelect.addEventListener('change', updatePrice);

        // Initial price update
        updatePrice();
    </script>
</body>
</html>
