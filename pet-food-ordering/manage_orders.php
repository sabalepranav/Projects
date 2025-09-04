<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Update Order Status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE orders SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    
    header("Location: manage_orders.php");
    exit();
}

// Delete Order
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    
    $stmt = $conn->prepare("DELETE FROM orders WHERE id=?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    
    header("Location: manage_orders.php");
    exit();
}

// Fetch Orders
$result = mysqli_query($conn, "SELECT * FROM orders");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('./assets/orders.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
        }
        h1 {
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
            text-align: center;
        }
        th {
            background: rgba(173, 216, 230, 0.7);
        }
        .status-form select {
            padding: 5px;
            font-family: 'Poppins', sans-serif;
        }
        .update-btn, .delete-btn {
            padding: 8px;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .update-btn {
            background: green;
            color: white;
        }
        .delete-btn {
            background: red;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
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
    <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>
    <h1>Manage Orders</h1>
    <table>
        <tr>
            <th>ID</th> <th>User</th> <th>Total Price</th> <th>Status</th> <th>Delete</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['user_id'] ?></td>
                <td>₹<?= $row['total_price'] ?></td>
                <td>
                    <form method="POST" class="status-form">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <select name="status">
                            <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Shipped" <?= $row['status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                            <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                        </select>
                        <button type="submit" name="update_status" class="update-btn">Update</button>
                    </form>
                </td>
                <td><a href="manage_orders.php?delete=<?= $row['id'] ?>" class="delete-btn">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
