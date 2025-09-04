<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Update Appointment Status
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    $appointment_id = $_POST['appointment_id'];
    $status = $_POST['status'];

    $query = "UPDATE appointments SET status='$status' WHERE id=$appointment_id";
    mysqli_query($conn, $query);
    header("Location: manage_appointments.php");
    exit();
}

// Delete Appointment
if (isset($_GET['delete'])) {
    $appointment_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM appointments WHERE id=$appointment_id");
    header("Location: manage_appointments.php");
    exit();
}

// Fetch Appointments
$result = mysqli_query($conn, "SELECT * FROM appointments");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Appointments</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), url('./assets/medical.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 95%;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        h2 {
            text-align: center;
            color: white;
            font-weight: 600;
        }
        table {
            width: 100%;
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
        .status-form select {
            padding: 5px;
        }
        .update-btn, .delete-btn {
            padding: 8px;
            border: none;
            cursor: pointer;
        }
        .update-btn {
            background: green;
            color: white;
        }
        .delete-btn {
            background: red;
            color: white;
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

    <div class="container">
        <a href="admin_dashboard.php" class="back-btn">← Back</a>
        <h2>Manage Appointments</h2>
        <table>
            <tr>
                <th>ID</th> <th>Name</th> <th>Email</th> <th>Phone</th> <th>Service</th> <th>Doctor</th> <th>Date</th> <th>Time</th> <th>Status</th> <th>Delete</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['service'] ?></td>
                    <td>
                        <?php
                        $doctor_names = [
                            1 => "Dr. A Sharma - Dog Specialist",
                            2 => "Dr. B Patel - Cat Specialist",
                            3 => "Dr. C Verma - Bird Specialist",
                            4 => "Dr. D Gupta - General Vet",
                            5 => "Dr. E Joshi - Exotic Pets Specialist"
                        ];
                        echo $doctor_names[$row['doctor_id']] ?? "Unknown Doctor";
                        ?>
                    </td>
                    <td><?= $row['appointment_date'] ?></td>
                    <td><?= $row['appointment_time'] ?></td>
                    <td>
                        <form method="POST" class="status-form">
                            <input type="hidden" name="appointment_id" value="<?= $row['id'] ?>">
                            <select name="status">
                                <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Confirmed" <?= $row['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option value="Completed" <?= $row['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                            <button type="submit" name="update_status" class="update-btn">Update</button>
                        </form>
                    </td>
                    <td><a href="manage_appointments.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>

</body>
</html>
