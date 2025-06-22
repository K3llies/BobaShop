<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'boba_database';
$username = 'root';
$password = 'csit355pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Fetch the admin's name from the database (using admin_name column)
$admin_id = $_SESSION['admin_id'];
$stmt = $pdo->prepare("SELECT admin_name FROM Admin WHERE admin_id = ?");
$stmt->execute([$admin_id]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    header('Location: admin_login.php');
    exit;
}

$admin_name = $admin['admin_name'];

if (isset($_GET['logout'])) {
    session_unset(); // Clear session variables
    session_destroy(); // Destroy the session
    header('Location: admin_login.php'); // Redirect to the login page
    exit;
}

// Handle adding new items
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_base'])) {
        $flavor = trim($_POST['flavor']);
        $stmt = $pdo->prepare("INSERT INTO Base (flavor) VALUES (?)");
        $stmt->execute([$flavor]);
        $_SESSION['message'] = "Base item added successfully!";
    } elseif (isset($_POST['add_topping'])) {
        $topping = trim($_POST['topping']);
        $price = floatval($_POST['price']);
        $stmt = $pdo->prepare("INSERT INTO Topping (toppings, additional_price) VALUES (?, ?)");
        $stmt->execute([$topping, $price]);
        $_SESSION['message'] = "Topping item added successfully!";
    } elseif (isset($_POST['add_size'])) {
        $size = trim($_POST['size']);
        $price = floatval($_POST['size_price']);
        $stmt = $pdo->prepare("INSERT INTO Size (sizes, size_price) VALUES (?, ?)");
        $stmt->execute([$size, $price]);
        $_SESSION['message'] = "Size item added successfully!";
    }
}

// Handle deleting items
if (isset($_POST['delete_base'])) {
    $base_id = intval($_POST['delete_base']);
    $stmt = $pdo->prepare("DELETE FROM Base WHERE base_id = ?");
    $stmt->execute([$base_id]);
    $_SESSION['message'] = "Base item deleted successfully!";
} elseif (isset($_POST['delete_topping'])) {
    $topping_id = intval($_POST['delete_topping']);
    $stmt = $pdo->prepare("DELETE FROM Topping WHERE topping_id = ?");
    $stmt->execute([$topping_id]);
    $_SESSION['message'] = "Topping item deleted successfully!";
} elseif (isset($_POST['delete_size'])) {
    $size_id = intval($_POST['delete_size']);
    $stmt = $pdo->prepare("DELETE FROM Size WHERE size_id = ?");
    $stmt->execute([$size_id]);
    $_SESSION['message'] = "Size item deleted successfully!";
}

// Fetch data for display
$base_items = $pdo->query("SELECT * FROM Base")->fetchAll(PDO::FETCH_ASSOC);
$topping_items = $pdo->query("SELECT * FROM Topping")->fetchAll(PDO::FETCH_ASSOC);
$size_items = $pdo->query("SELECT * FROM Size")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Dashboard</h2>
        <p class="text-center">Welcome, <?php echo htmlspecialchars($admin_name); ?></p>
    
        <!-- Logout Link -->
        <div class="text-center">
            <a href="?logout" class="btn btn-danger">Logout</a>
        </div>

        <!-- Display success message if available -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <div class="row">
            <!-- Add new Base -->
            <div class="col-md-4">
                <h3>Add New Base</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="flavor" class="form-label">Flavor</label>
                        <input type="text" class="form-control" id="flavor" name="flavor" required>
                    </div>
                    <button type="submit" name="add_base" class="btn btn-primary w-100">Add Base</button>
                </form>
            </div>

            <!-- Add new Topping -->
            <div class="col-md-4">
                <h3>Add New Topping</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="topping" class="form-label">Topping</label>
                        <input type="text" class="form-control" id="topping" name="topping" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <button type="submit" name="add_topping" class="btn btn-primary w-100">Add Topping</button>
                </form>
            </div>

            <!-- Add new Size -->
            <div class="col-md-4">
                <h3>Add New Size</h3>
                <form method="POST">
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" class="form-control" id="size" name="size" required>
                    </div>
                    <div class="mb-3">
                        <label for="size_price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="size_price" name="size_price" required>
                    </div>
                    <button type="submit" name="add_size" class="btn btn-primary w-100">Add Size</button>
                </form>
            </div>
        </div>

        <hr>

        <!-- Display and manage Base items -->
        <h3>Base Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Flavor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($base_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['flavor']); ?></td>
                        <td>
                            <!-- Delete button with confirmation -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="delete_base" value="<?php echo $item['base_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Display and manage Topping items -->
        <h3>Topping Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Topping</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topping_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['toppings']); ?></td>
                        <td>$<?php echo number_format($item['additional_price'], 2); ?></td>
                        <td>
                            <!-- Delete button with confirmation -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="delete_topping" value="<?php echo $item['topping_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Display and manage Size items -->
        <h3>Size Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($size_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['sizes']); ?></td>
                        <td>$<?php echo number_format($item['size_price'], 2); ?></td>
                        <td>
                            <!-- Delete button with confirmation -->
                            <form method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                <input type="hidden" name="delete_size" value="<?php echo $item['size_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
