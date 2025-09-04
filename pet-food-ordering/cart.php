<?php
session_start();
include "db.php";



// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove item from cart
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit();
}

// Update cart quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    foreach ($_POST['quantity'] as $product_id => $qty) {
        $_SESSION['cart'][$product_id]['quantity'] = $qty;
    }
}

// Fetch product details for cart items
$cart_items = [];
$total_price = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(",", array_keys($_SESSION['cart']));
    $query = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['id']]['quantity'];
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total_price += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart - Pet Pooja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; text-align: center; background-color: #f0f8ff;
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)),url('./assets/index.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */ }
        .container { width: 80%; margin: auto; background: rgba(255, 255, 255, 0.2); /* Light transparent white */
            backdrop-filter: blur(10px); }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; }
        .btn { padding: 8px 12px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        .btn1{
             padding: 8px 12px; background: #4CAF50; color: white; border: none; cursor: pointer; 
        }
        .btn:hover { background: #45a049; }
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
<a href="index.php" class="back-btn">⬅ Back</a>
<h2>🛒 Your Cart</h2>

<div class="container">
    <form method="POST">
        <table border="1">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php foreach ($cart_items as $item) { ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>₹<?php echo $item['price']; ?></td>
                <td><input type="number" name="quantity[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1"></td>
                <td>₹<?php echo $item['subtotal']; ?></td>
                <td>
                    <a href="cart.php?remove=<?php echo $item['id']; ?>" class="btn">Remove</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <h3>Total: ₹<?php echo $total_price; ?></h3>
        <?php $_SESSION['total_price'] = $total_price; ?>

        <a><button type="submit" name="update" class="btn">Update Cart</button></a>
        <a href="checkout.php" class="btn">Proceed to Checkout</a>
    </form>
</div>

</body>
</html>
