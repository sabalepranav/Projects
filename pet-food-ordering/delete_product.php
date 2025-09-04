<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the product from the database
    $query = "DELETE FROM products WHERE id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_products.php"); // Redirect to product page
        exit();
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
} else {
    header("Location: manage_products.php");
    exit();
}
?>
