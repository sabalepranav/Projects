<?php
session_start();
include ('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Pooja - Order Food & Accessories</title>
    <style>
        /* Poppins Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)),url('./assets/index.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */
            background-color: #f0f8ff; /* Light Blue */
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(255, 255, 255, 0.2); /* Light transparent white */
            backdrop-filter: blur(10px);
            padding: 15px 30px;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navbar .links a {
            text-decoration: none;
            margin: 0 15px;
            color: #333;
            font-weight: 600;
        }

        .navbar .links a:hover {
            color: #ff6b81; /* Light Pink */
        }


        .footer {
            display: flex;
            justify-content: center; /* Center content horizontally */
            align-items: center;
            background-color: #90EE90; /* Sky Blue */
            padding: 15px 30px;
        }

        .footer-links {
            display: flex;
            gap: 20px; /* Space between links */
        }

        .footer-links a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
        }

        .footer-links a:hover {
            color: #ff6b81; /* Light Pink */
        }


        /* Main Section */
        .main {
            text-align: center;
            margin: 50px 20px;
        }

        .main h1 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
        }

        /* Categories Section */
        .categories, .medical, .accessories, .feedback {
            margin: 30px auto;
            text-align: center;
        }

        .categories h2, .medical h2, .accessories h2 {
            font-size: 24px;
            margin-bottom: 20px;
            
        }
        .feedback h2 {
            font-size: 24px;
            margin-bottom: 15px;
            padding-bottom: 25px;
        }

        /* Cards Layout */
        .card-container {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            width: 220px; /* Adjust Width */
            height: 300px; /* Adjust Height */
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: white;
            background-size: cover; /* Cover full card */
            background-position: center; /* Center image */
            background-repeat: no-repeat;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.3);
        }

        /* Background Images */
        .dog-card { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/dog.jpg'); }
        .cat-card { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/cat.jpg'); }
        .bird-card { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/bird.jpg'); }
        .fish-card { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/fish.jpg'); }
        .horse-card { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/horse.jpg'); }



        .big-card-medical {
            width: 65%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 50vh;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./assets/medical.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            color: white;

            /* Centering */
            margin: 0 auto; /* Horizontally center */
            display: flex;
        }


        .big-card-medical:hover {
            background-color: #ffd8a8; /* Slightly darker orange on hover */
            transform: scale(1.02);
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .big-card-accessories {
            width: 65%;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 50vh;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('./assets/accessories.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            color: white;

            /* Centering */
            margin: 0 auto; /* Horizontally center */
            display: flex;
        }


        .big-card-accessories:hover {
            background-color: #ffd8a8; /* Slightly darker orange on hover */
            transform: scale(1.02);
            box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Glassy Button Styles */
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin-top: 15px;
            background: rgba(255, 255, 255, 0.2); /* Transparent white */
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 30px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px); /* Glass effect */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease-in-out;
        }

        /* Hover Effect */
        .btn:hover {
            background: rgba(255, 255, 255, 0.3); /* More visible white */
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        /* Feedback Section */
        .feedback {
            
            padding: 30px 0;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }

        /* Container to Hide Overflow */
        .feedback-container {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        /* Feedback Scrolling Slider */
        .feedback-slider {
            display: flex;
            gap: 20px;
            width: max-content;
            animation: scrollFeedback 30s linear infinite; /* Auto-scroll */
        }

        /* Individual Feedback Cards */
        .feedback-card {
            background-color: #ff6b81; /* Light Pink Card */
            color: white;
            padding: 15px 20px;
            border-radius: 10px;
            font-size: 16px;
            min-width: 250px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }

        /* Animation for Scrolling */
        @keyframes scrollFeedback {
            0% { transform: translateX(5%); }
            100% { transform: translateX(-5%); }
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .big-card {
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">🐾 Pet Pooja</div>
        <div class="links">
            <a href="index.php">Home</a>
            

            <?php if (isset($_SESSION['user_id'])): ?>  
                <!-- Show only if user is logged in -->
                <a href="shop.php">Shop</a>
                <a href="cart.php">Cart</a>
                <a href="orders.php">Orders</a>
                <a href="profile.php">Profile</a>
                <a href="logout.php" style="color:red;">Logout</a>
            <?php else: ?>
                <!-- Show only if user is NOT logged in -->
                <a href="login.php">Login</a>
                <a href="signup.php">Signup</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Section -->
    <div class="main">
        <h1><b>Order the Best Food & Accessories for Your Pets! 🐶🐱</b></h1>
    </div>

    <!-- Pet Food Categories -->
    <div class="categories">
        <h2>Order Food For</h2>
        <div class="card-container">
            <a href="product.php?category=dog_food" class="card dog-card">🐶 Dogs</a>
            <a href="product.php?category=cat_food" class="card cat-card">🐱 Cats</a>
            <a href="product.php?category=bird_food" class="card bird-card">🐦 Birds</a>
            <a href="product.php?category=fish_food" class="card fish-card">🐠 Fishes</a>
            <a href="product.php?category=horse_food" class="card horse-card">🐎 Horses</a>
        </div>

    </div>


    <!-- Medical Help Section -->
    <div class="medical">
        <h2><br><br>🐾 Need Medical Help?</h2>
        <div class="big-card-medical">
            <p>Get professional vet support for your pets! Book an online consultation now.</p>
            <a href="book_appointment.php" class="btn">Book Appointment !</a>
        </div>
    </div>

    <!-- Accessories Section -->
    <div class="accessories">
        <h2><br><br>🛍️ Pet Accessories</h2>
        <div class="big-card-accessories">
            <p>Buy toys, grooming kits, and more for your furry friends!</p>
            <a href="shop.php" class="btn">Buy Now!</a>
        </div>
    </div>


    <!-- Feedback Section -->
    <div class="feedback">
        <h2><br><br>📢 What Our Customers Say</h2>
        <div class="feedback-container">
            <div class="feedback-slider">
                <div class="feedback-card">"Amazing service! My pet loves the food!" - Pranav</div>
                <div class="feedback-card">"Great accessories, fast delivery!" - Sayali</div>
                <div class="feedback-card">"Vet consultation was very helpful!" - Sakshi</div>
                <div class="feedback-card">"Best pet food quality, my dog is happy!" - Vaishnavi</div>
                <div class="feedback-card">"Affordable prices and great products!" - Aniket</div>
                <div class="feedback-card">"Quick delivery and fantastic service!" - Aditi</div>
                <div class="feedback-card">"Will definitely shop again!" - Manish</div>
                <div class="feedback-card">"Amazing service! My pet loves the food!" - Rahul</div>
                <div class="feedback-card">"Great accessories, fast delivery!" - Priya</div>
                <div class="feedback-card">"Vet consultation was very helpful!" - Ankit</div>
                <div class="feedback-card">"Loved the grooming products!" - Sneha</div>
                <div class="feedback-card">"Best pet shop ever!" - Vishal</div>
                <div class="feedback-card">"Quality food for my puppy!" - Aarav</div>
                <div class="feedback-card">"Affordable prices and excellent service!" - Meera</div>
                <div class="feedback-card">"On-time delivery, very satisfied!" - Kunal</div>
            </div>
        </div>
    </div>


     <!-- Footer -->
     <div class="footer">
        <div class="footer-links">
            <a href="about.html">About Us</a>
            <a href="contact.html">Contact Us</a>
            <a href="contact.html">Feedback</a>
        </div>
    </div>


  

</body>
</html>
