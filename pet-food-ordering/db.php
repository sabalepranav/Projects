<?php
$host = "localhost";
$user = "root"; // Default for XAMPP
$password = ""; // No password in XAMPP
$database = "pet_pooja"; // Database name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
