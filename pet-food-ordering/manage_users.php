<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Update User Role
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_role'])) {
    $user_id = $_POST['user_id'];
    $role = $_POST['role'];

    $stmt = $conn->prepare("UPDATE users SET role=? WHERE user_id=?");
    $stmt->bind_param("si", $role, $user_id);
    $stmt->execute();

    header("Location: manage_users.php");
    exit();
}

// Delete User
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];

    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    header("Location: manage_users.php");
    exit();
}

// Fetch Users
$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('./assets/users.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
        }
        h1 {
            margin-top: 20px;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.3);
            color: black;
        }
        th, td {
            padding: 10px;
            border: 1px solid white;
            text-align: center;
        }
        th {
            background: rgba(173, 216, 230, 0.7);
        }
        .role-form select {
            padding: 5px;
            font-family: 'Poppins', sans-serif;
        }
        .update-btn, .delete-btn {
            padding: 8px;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
        }
        .update-btn {
            background: green;
            color: white;
        }
        .delete-btn {
            background: red;
            color: white;
            text-decoration: none;
            padding: 5px 10px;
            display: inline-block;
        }
        .back-btn {
            font-family: 'Poppins', sans-serif;
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            color: black;
            font-weight: bold;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }
    </style>
</head>
<body>
    <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>
    <h1>Manage Users</h1>
    <table>
        <tr>
            <th>User ID</th> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Address</th> <th>Role</th> <th>Created At</th> <th>Delete</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= $row['address'] ?></td>
                <td>
                    <form method="POST" class="role-form">
                        <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
                        <select name="role">
                            <option value="user" <?= $row['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                        <button type="submit" name="update_role" class="update-btn">Update</button>
                    </form>
                </td>
                <td><?= $row['created_at'] ?></td>
                <td><a href="manage_users.php?delete=<?= $row['user_id'] ?>" class="delete-btn">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
