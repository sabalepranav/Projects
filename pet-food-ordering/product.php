<?php
session_start();
include "db.php"; // Database Connection

// Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace("_", " ", $category)); ?> - Shop</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Page Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('./assets/accessories.jpg') no-repeat center center/cover;
            backdrop-filter: blur(5px);
            background-attachment: fixed;
            color: black;
        }
        h1{
            color: white;
        }
        /* Container */
        .container {
            width: 80%;
            margin: auto;
        }

        /* Product Grid */
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Product Card */
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

        /* Product Image */
        img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Buttons */
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

         /* Back Button */
         .back-btn {
            font-family: 'Poppins', sans-serif;
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
<a href="index.php" class="back-btn">← Back</a>
    <h1>🐾 <?php echo ucfirst(str_replace("_", " ", $category)); ?> Shop</h1>
    <div class="container">
        <div class="products">
            <?php
            // Fetch products of the selected category
            $query = "SELECT * FROM products WHERE category='$category'";
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
