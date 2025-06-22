<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$dbname = 'boba_database';
$username = 'root';
$password = 'csit355pass';

// Create a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$error = ''; // Variable to store any login errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the input admin ID
    $admin_id = trim($_POST['admin_id']);

    // Validate the input (ensure it's a number)
    if (empty($admin_id) || !is_numeric($admin_id)) {
        $error = 'Please enter a valid Admin ID.';
    } else {
        // Check if the admin ID exists in the Admin table
        $stmt = $pdo->prepare("SELECT * FROM Admin WHERE admin_id = ?");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            // If the admin ID is found, set the session and redirect to the admin dashboard
            $_SESSION['admin_id'] = $admin_id;
            header('Location: admin_dashboard.php'); // Redirect to the admin dashboard page
            exit;
        } else {
            // If no match is found, show an error message
            $error = 'Admin ID not found.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFD7F7;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Admin Login</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST" action="admin_login.php">
            <div class="mb-3">
                <label for="admin_id" class="form-label">Admin ID</label>
                <input type="text" class="form-control" id="admin_id" name="admin_id" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        <!-- Link to the index page -->
        <div class="text-center mt-3">
            <a href="index.php" class="btn btn-secondary">Back to Home</a>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
