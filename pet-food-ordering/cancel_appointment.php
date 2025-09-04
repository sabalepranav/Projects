<?php
include 'db.php';
$id = $_GET['id'];

$conn->query("UPDATE appointments SET status='Cancelled' WHERE id=$id");
echo "<script>alert('Appointment Cancelled!'); window.location='admin_appointments.php';</script>";
?>
