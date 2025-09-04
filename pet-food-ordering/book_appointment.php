<?php
session_start();
include 'db.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'] ?? NULL; // If logged in, get user ID
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $doctor_id = $_POST['doctor_id']; 
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "INSERT INTO appointments (user_id, name, email, phone, service, doctor_id, appointment_date, appointment_time, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssiss", $user_id, $name, $email, $phone, $service, $doctor_id, $appointment_date, $appointment_time);
    
    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!'); window.location='book_appointment.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment</title>
    <style>
        /* Import Poppins Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* Page Background */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url('./assets/medical.jpg') no-repeat center center/cover; /* Set background image */
            backdrop-filter: blur(5px); /* Slight blur effect */
            background-attachment: fixed; /* Keeps background image fixed */
        }

        /* Glassy Card Effect */
        .container {
            background: rgba(255, 255, 255, 0.2); /* Transparent white */
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            width: 450px;
            backdrop-filter: blur(10px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h2 {
            text-align: center;
            color: white; /* Light Green */
            font-weight: 600;
        }

        /* Input Fields */
        label {
            font-weight: 400;
            display: block;
            margin-top: 10px;
            color: #fff; /* White text for contrast */
        }

        input, select {
            width: 95%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.4); /* Light transparency */
            border: none;
            color: #333;
        }

        /* Submit Button */
        button {
            width: 100%;
            padding: 10px;
            background-color: #ff6b81; /* Light Pink */
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 15px;
            font-weight: 600;
        }

        button:hover {
            background-color: #ff6b70;
        }

        /* Responsive Design */
        @media (max-width: 450px) {
            .container {
                width: 90%;
            }
        }

        .back-btn {
        display: inline-block;
        padding: 5px 10px;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: 0.3s;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    </style>
</head>
<body>

    <div class="container">
    <a href="index.php" class="back-btn">← Back</a>
        <h2>Book an Appointment</h2>
        <form method="post">
            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Phone:</label>
            <input type="text" name="phone" required>

            <label>Service:</label>
            <input type="text" name="service" required>

            <label>Select Doctor:</label>
            <select name="doctor_id" required>
                <option value="">Select Doctor</option>
                <option value="1">Dr. A Sharma - Dog Specialist</option>
                <option value="2">Dr. B Patel - Cat Specialist</option>
                <option value="3">Dr. C Verma - Bird Specialist</option>
                <option value="4">Dr. D Gupta - General Vet</option>
                <option value="5">Dr. E Joshi - Exotic Pets Specialist</option>
            </select>

            <label>Date:</label>
            <input type="date" name="appointment_date" required>

            <label>Time:</label>
            <input type="time" name="appointment_time" required>

            <button type="submit">Book Appointment</button>
        </form>
    </div>
</body>
</html>
