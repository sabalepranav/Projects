<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = strtolower(trim($_POST['email']));
    $message = $_POST['message'];

    // ✅ Gmail validation
    if (!preg_match("/^[a-z0-9._%+-]+@gmail\.com$/i", $email)) {
        echo "<script>alert('Only @gmail.com emails allowed!'); window.history.back();</script>";
        exit;
    }

    // ✅ Insert into DB
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!'); window.location='contact.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>