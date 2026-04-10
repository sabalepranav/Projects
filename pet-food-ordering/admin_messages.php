<?php
include 'db.php';

$result = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Inbox</title>

    <!-- ✅ Poppins Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ✅ Apply Poppins everywhere */
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            padding: 20px;
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                        url('./assets/index.jpg') no-repeat center/cover;
            min-height: 100vh;
            color: white;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: rgba(255,255,255,0.2);
            font-weight: 500;
        }

        tr {
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        tr:hover {
            background: rgba(255,255,255,0.1);
        }

        td {
            color: #f1f1f1;
            font-size: 14px;
        }

        .message-box {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 15px;
            text-decoration: none;
            color: white;
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            transition: 0.3s;
            font-size: 14px;
        }

        .back-btn:hover {
            background: rgba(255,255,255,0.4);
        }

        /* 📱 Responsive */
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                padding: 10px;
                border-bottom: 1px solid #ccc;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>

    <h2>📩 Inbox Messages</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Message</th>
            <th>Date</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td class="message-box"><?php echo $row['message']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>