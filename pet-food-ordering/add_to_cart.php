<?php
session_start();
include "db.php";

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = ['quantity' => 1];
    } else {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    }
    
    header("Location: cart.php");
    exit();
}
?>
