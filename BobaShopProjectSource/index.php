<?php
include('navbar.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boba Shop - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section {
            padding: 50px 0;
        }
        .photo-gallery img {
            width: 30%;
            margin: 0 10px;
            border-radius: 8px;
        }
        .about-text {
            text-align: center;
            font-size: 1.2rem;
            margin-top: 20px;
        }
        .contact-info {
            text-align: center;
        }
        body {
            background-color: #FFD7F7;
        }
        .photo-gallery img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            margin: 0 10px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

    <!-- About Us Section -->
    <section class="section about-us">
        <div class="container">
            <h2 class="text-center">About Us</h2>
            <div class="about-text">
                <p>Welcome to Kelly's and Becca's Boba Shop! We are dedicated to serving the best boba drinks with a variety of flavors and toppings to choose from. Whether you're a fan of traditional teas or adventurous fruit blends, we have something for everyone.</p>
                <p>Our mission is to bring the joy of fresh, delicious boba to your day, with every sip.</p>
            </div>
        </div>
    </section>

    <!-- Photo Gallery Section -->
    <section class="section photo-gallery">
        <div class="container">
            <h2 class="text-center">Photo Gallery</h2>
            <div class="d-flex justify-content-center">
                <img src="milk1.jpg" alt="Boba Drink 1">
                <img src="milk2.jpg" alt="Boba Drink 2">
                <img src="milk3.jpg" alt="Boba Drink 3">
                <img src="milk4.jpg" alt="Boba Drink 4">
            </div>
            <div class="d-flex justify-content-center">
                <img src="milk5.jpg" alt="Boba Drink 5">
                <img src="milk6.jpg" alt="Boba Drink 6">
                <img src="milk7.jpg" alt="Boba Drink 7">
                <img src="milk8.jpg" alt="Boba Drink 8">
            </div>
            <div class="d-flex justify-content-center">
                <img src="fruit1.jpg" alt="Boba Drink 9">
                <img src="fruit2.jpg" alt="Boba Drink 10">
                <img src="fruit3.jpg" alt="Boba Drink 11">
                <img src="fruit4.jpg" alt="Boba Drink 12">
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section class="section contact-us">
        <div class="container">
            <h2 class="text-center">Contact Us</h2>
            <div class="contact-info">
                <p>For more information, you can reach us at:</p>
                <p>Email: KBBoba@gmail.com</p>
                <p>Phone: (973) 655-4000</p>
                <p>1 Normal Ave, Montclair, NJ 07043</p>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
