<?php
session_start();
include 'db.php';

// Only Admin can delete users
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if user_id is provided
if (isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']); // Convert to integer for security

    // Prevent deleting yourself (Optional)
    if ($user_id == $_SESSION['user_id']) {
        echo "<script>alert('You cannot delete yourself!'); window.location.href='manage_users.php';</script>";
        exit();
    }

    // Prepare delete query
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        echo "<script>alert('User deleted successfully!'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user.'); window.location.href='manage_users.php';</script>";
    }
} else {
    header("Location: manage_users.php");
    exit();
}
?>
