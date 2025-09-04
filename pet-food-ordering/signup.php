<?php
session_start();
include "db.php"; // Database Connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    
    // Default role is 'user'
    $role = 'user';

    // Check if email already exists
    $checkQuery = "SELECT * FROM users WHERE email='$email'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $error = "Email already registered!";
    } else {
        // Insert new user
        $query = "INSERT INTO users (name, email, password, phone, address, role, created_at) 
                  VALUES ('$name', '$email', '$password', '$phone', '$address', '$role', NOW())";

        if (mysqli_query($conn, $query)) {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;

            header("Location: index.php"); // Redirect to homepage
            exit();
        } else {
            $error = "Signup failed. Try again!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup - Pet Pooja</title>
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

        /* Signup Message */
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
        <h2>Signup for Pet Pooja</h2>
        <?php if(isset($error)) echo "<p style='color:#ff4757;'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <input type="text" name="address" placeholder="Address" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
