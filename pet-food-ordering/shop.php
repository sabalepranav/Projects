<?php
session_start();
include "db.php"; // Database Connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Accessories - Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('./assets/accessories.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .product-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 15px;
            margin: 15px;
            width: 250px;
            text-align: center;
        }
        img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        .btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }
        .btn:hover {
            background: #45a049;
        }
        h1{
            color: white;
        }
        .back-btn {
        display: inline-block;
        padding: 5px 10px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: 0.3s;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    </style>
</head>
<body>

    <h1><a href="index.php" class="back-btn">← Back</a>🐾 Pet Accessories Shop</h1>
    <div class="container">
        <div class="products">
            <?php
            // Fetch accessories from the database
            $query = "SELECT * FROM products WHERE category='accessory'";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-card'>
                        <img src='assets/" . $row['image'] . "' alt='" . $row['name'] . "'>
                        <h3>" . $row['name'] . "</h3>
                        <p>₹" . $row['price'] . "</p>
                        <p>" . $row['description'] . "</p>
                        <form method='POST' action='add_to_cart.php'>
                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                            <button type='submit' class='btn'>Add to Cart</button>
                        </form>
                    </div>";
            }
            ?>
        </div>
    </div>

</body>
</html>
