<?php
session_start();
include "db.php";

// Check if user is logged in
if (!isset($_SESSION['user_id'])) { 
    die("❌ Error: User not logged in. Please <a href='login.php'>Login</a>.");
}

$user_email = $_SESSION['user_id']; // Using email as session ID

// 🔹 Fetch `user_id` from `users` table using email
$user_query = "SELECT user_id FROM users WHERE email = '$user_email' LIMIT 1";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    die("❌ Error: User email not found in database.");
}

$user_data = mysqli_fetch_assoc($user_result);
$user_id = $user_data['id']; // Correct user_id from database

// Debugging Output
echo "User Email from session: " . $user_email . "<br>";
echo "Fetched User ID from database: " . $user_id . "<br>";

// 🔹 Collect Order Details
$total_price = $_SESSION['total_price'] ?? 0;
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);

// 🔹 Insert Order into `orders` Table
$order_query = "INSERT INTO orders (user_id, total_price, status, customer_name, address, phone) 
                VALUES ('$user_id', '$total_price', 'Pending', '$customer_name', '$address', '$phone')";

if (mysqli_query($conn, $order_query)) {
    header("Location: order_success.php"); // Redirect on success
    exit();
} else {
    die("❌ SQL Error: " . mysqli_error($conn)); // Debugging SQL errors
}
?>
