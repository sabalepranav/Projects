<?php
session_start();
include "db.php"; // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Get logged-in user's ID

// Fetch orders for the logged-in user
$query = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Orders - Pet Pooja</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        body {
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, 0)),url('./assets/index.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background-color: #f0f8ff;
            margin: 0;
            padding: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.2); /* Light transparent white */
            backdrop-filter: blur(10px);
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        .btn {
            padding: 5px 10px;
            background: #4CAF50;
            color: white;
            border: none;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background: #45a049;
        }
        /* Back Button */
        .back-btn {
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



<div class="container">

    <h2>📦 My Orders</h2>
    <a href="index.php" class="back-btn">⬅ Back</a>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Order Date</th>
            
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>₹<?php echo $row['total_price']; ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo $row['created_at']; ?></td>
            
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
