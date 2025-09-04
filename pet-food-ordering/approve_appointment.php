<?php
include 'db.php';
$id = $_GET['id'];

$conn->query("UPDATE appointments SET status='Approved' WHERE id=$id");
echo "<script>alert('Appointment Approved!'); window.location='admin_appointments.php';</script>";
?>
