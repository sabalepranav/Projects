<?php
session_start();
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
if (!isset($_SESSION['total_price']) || $_SESSION['total_price'] <= 0) {
    die("Total price is missing. Please add items to cart.");
}
$total_price = $_SESSION['total_price'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Pet Pooja</title>
    <style>
        /* Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Reset Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body */
        body {
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)),url('./assets/index.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */ 
            
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            position: relative;
        }

        /* Checkout Card */
        .checkout-card {
            background: rgba(255, 255, 255, 0.2); /* Light transparent white */
            backdrop-filter: blur(10px);
            
            padding: 25px;
            width: 400px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Heading */
        h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Labels */
        label {
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            display: block;
            color: #555;
        }

        /* Input Fields */
        input {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #28a745;
        }

        /* Order Summary */
        .order-summary {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            margin-top: 10px;
            text-align: left;
            font-size: 14px;
        }

        /* Submit Button */
        button {
            background: #28a745;
            color: white;
            font-size: 16px;
            font-weight: 600;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #218838;
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

    <a href="cart.php" class="back-btn">⬅ Back to Cart</a>

    <div class="checkout-card">
        <h2>Checkout</h2>
        <form method="POST" action="confirm_order.php">
            <label>Full Name:</label>
            <input type="text" name="name" required>

            <label>Address:</label>
            <input type="text" name="address" required>

            <label>Phone Number:</label>
            <input type="text" name="phone" required>

            <h3>Order Summary:</h3>
            <div class="order-summary">
                <?php foreach ($_SESSION['cart'] as $id => $item) { ?>
                    <p>Quantity: <?php echo $item['quantity']; ?></p>
                <?php } ?>
            </div>
            <input type="hidden" name="total_price" value="<?php echo $_SESSION['total_price']; ?>">
            <button type="submit" name="place_order">Confirm Order</button>
        </form>
    </div>

</body>
</html>
