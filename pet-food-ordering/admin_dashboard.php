<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Admin Dashboard</title>
    <style>
        /* Background Image */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('./assets/admin_bg.jpg') no-repeat center center/cover; /* Set background image */
    backdrop-filter: blur(5px); /* Slight blur effect */
    background-attachment: fixed; /* Keeps background image fixed */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

/* Container */
.container {
    text-align: center;
    width: 80%;
}

/* Dashboard Title */
.title {
    font-size: 32px;
    font-weight: bold;
    color: white;
    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

/* Card Container */
.cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 30px 0;
}

/* Glassy Cards */
.card {
    width: 270px;
    height: 330px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
    transition: transform 0.3s, background 0.3s;
}

.card:hover {
    transform: scale(1.05);
   
}

/* Logout Button */
.logout-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: red;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s;
}

.logout-btn:hover {
    background: darkred;
}
.product { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/accessories.jpg'); }
.orders { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/orders.jpg'); }
.users { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/users.jpg'); }
.appointment { background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),url('assets/medical.jpg'); }
        </style>
</head>
<body>
    <div class="container">
        <h1 class="title">Welcome to Admin Dashboard</h1>

        <div class="cards">
            <a href="manage_products.php" class="card product">
                <h2>Manage Products</h2>
            </a>
            <a href="manage_orders.php" class="card orders">
                <h2>Manage Orders</h2>
            </a>
            <a href="manage_users.php" class="card users">
                <h2>Manage Users</h2>
            </a>
            <a href="manage_appointments.php" class="card appointment">
                <h2>Manage Appointments</h2>
            </a>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
