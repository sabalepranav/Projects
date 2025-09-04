<?php
session_start();
include "db.php"; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Session Email is missing. Please <a href='login.php'>Login</a>");
}

$user_email = mysqli_real_escape_string($conn, $_SESSION['user_id']); // Using email as user_id


// Query to fetch user details using email
$query = "SELECT * FROM users WHERE email = '$user_email' LIMIT 1";
$result = mysqli_query($conn, $query);

// Check if user exists
if (!$result || mysqli_num_rows($result) == 0) {
    die("User not found. Please check the database.");
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Profile - Pet Pooja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            text-align: center;
            background: url('./assets/index.jpg') no-repeat center center/cover; /* Background image */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.2); /* Glassy effect */
            backdrop-filter: blur(15px);
            padding: 30px;
            width: 350px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
        }
        .btn {
            padding: 10px 15px;
            background: #4CAF50;
            color: white;
            border: none;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn:hover {
            background: #45a049;
        }
        .welcome {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .details {
            color: #333;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="welcome">Welcome, <?php echo htmlspecialchars($user['name']); ?>! 👋</div>
    <img src="./assets/default.webp" alt="Profile Photo" class="profile-pic"> <!-- Change image path if needed -->
    <div class="details">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
    </div>
    <a href="index.php" class="btn">Home</a>
    <a href="logout.php" class="btn">Logout</a>
</div>

</body>
</html>
