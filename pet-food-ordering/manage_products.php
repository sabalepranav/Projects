<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'db.php';

// Add Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $upload_dir = "assets/";
        $image_path = basename($image_name);

        if (move_uploaded_file($image_tmp, $image_path)) {
            // Insert into database
            $query = "INSERT INTO products (name, price, description, image, category) 
                      VALUES ('$name', '$price', '$description', '$image_path', '$category')";
            mysqli_query($conn, $query);
        }
    }
}

// Fetch Products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Products</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        /* General Styling */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.7)), 
                url('./assets/accessories.jpg') no-repeat center center/cover;
            background-attachment: fixed; /* Keeps background image fixed */
            backdrop-filter: blur(5px); /* Slight blur effect */
            margin: 0;
            padding: 20px;
            text-align: center;
            
        }

        /* Back Button */
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

        /* Title */
        h1 {
            font-weight: 600;
            margin-top: 50px;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        }

        /* Big Card */
        .card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            width: 50%;
            margin: auto;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input, textarea, select {
            font-family: 'Poppins', sans-serif;
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.5);
            font-size: 16px;
        }

        button {
            font-family: 'Poppins', sans-serif;
            width: 50%;
            padding: 12px;
            background: #77dd77; /* Light Green */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #66c066;
        }

        /* Product Table */
        table {
            width: 90%;
            margin: auto;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            overflow: hidden;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid white;
            border-collapse: collapse;
            padding: 12px;
            text-align: center;
            color: black;
            font-weight: bold;
        }

        th {
            background: rgba(173, 216, 230, 0.7); /* Light Blue */
        }

        /* Delete Button */
        .delete-btn {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }

        .delete-btn:hover {
            color: darkred;
        }
    </style>
</head>
<body>
    <a href="admin_dashboard.php" class="back-btn">⬅ Back</a>

    <h1>Manage Products</h1>

    <div class="card">
        <h3>Add Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="number" name="price" placeholder="Price" required>
            <textarea name="description" placeholder="Description" required></textarea>

            <!-- Image Upload -->
            <input type="file" name="image" required>

            <!-- Dropdown Category -->
            <select name="category" required>
                <option value="accessory">Accessories</option>
                <option value="dog_food">Dogs Food</option>
                <option value="cat_food">Cats Food</option>
                <option value="fish_food">Fishes Food</option>
                <option value="bird_food">Birds Food</option>
                <option value="horse_food">Horse Food</option>
            </select>

            <button type="submit" name="add_product">Add Product</button>
        </form>
    </div>

    <h3>Product List</h3>
    <table>
        <tr>
            <th>ID</th> <th>Name</th> <th>Price</th> <th>Description</th> <th>Image</th> <th>Category</th> <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= $row['description'] ?></td>
                <td><img src="<?= $row['image'] ?>" width="50"></td>
                <td><?= $row['category'] ?></td>
                <td><a href="delete_product.php?id=<?= $row['id'] ?>" class="delete-btn">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
