<?php
session_start();
include "db.php"; // Database Connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user in database
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['user_id'] = $email;
        $_SESSION['role'] = $user['role']; // Storing user role

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Pet Pooja</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Full Page Background */
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0)), 
                        url('./assets/index.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Glassy Effect Card */
        .container {

            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            width: 350px;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Title */
        h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 15px;
        }

        /* Input Fields */
        input {
            font-family: 'Poppins', sans-serif;
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.4); /* Transparent input */
            color: #333;
            outline: none;
        }

        input::placeholder {
            color: #333;
        }

        /* Button */
        button {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            padding: 10px;
            background: #ff6b81; /* Soft pink */
            border: none;
            color: #333;
            font-size: 16px;
            border-radius: 20px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
        }

        button:hover {
            background: #ff4757; /* Slightly darker pink */
        }

        /* Sign-up link */
        p {
            color: #333;
            font-size: 14px;
        }

        a {
            color: #ff6b81;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: #ff4757;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login to Pet Pooja</h2>
        <?php if(isset($error)) echo "<p style='color:#ff4757;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
