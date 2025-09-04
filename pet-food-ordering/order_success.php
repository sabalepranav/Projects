<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success - Pet Pooja</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .container {
            font-family: 'Poppins', sans-serif;
            width: 50%;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        h2 {
            font-family: 'Poppins', sans-serif;
            color: #4CAF50;
        }
        p {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            color: #333;
        }
        .btn {
            font-family: 'Poppins', sans-serif;
            display: inline-block;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
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

<a href="index.php" class="back-btn">⬅ Back</a>

<div class="container">
    <h2>🎉 Order Placed Successfully! 🎉</h2>
    <p>Thank you for shopping with Pet Pooja. Your order has been successfully placed.</p>
    <p>We will contact you soon for further updates.</p>
    <a href="index.php" class="btn">Continue Shopping</a>
</div>

</body>
</html>
