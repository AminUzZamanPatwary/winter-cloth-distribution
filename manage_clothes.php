<?php
include "db.php";

// ADD CLOTH
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $qty  = $_POST['quantity'];

    $sql = "INSERT INTO Cloth (cloth_name, type, size, quantity)
            VALUES ('$name', '$type', '$size', '$qty')";
    mysqli_query($conn, $sql);
}

// DELETE CLOTH
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Cloth WHERE cloth_id=$id");
}

// FETCH DATA
$data = mysqli_query($conn, "SELECT * FROM Cloth");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Clothes</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }

        button {
            padding: 10px;
            background: #2a5298;
            color: white;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background: #2a5298;
            color: white;
        }

        a {
            color: red;
            text-decoration: none;
        }

        .back {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #2a5298;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Manage Clothes</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Cloth Name" required>
        <input type="text" name="type" placeholder="Type">
        <input type="text" name="size" placeholder="Size">
        <input type="number" name="quantity" placeholder="Quantity" required>
        <button name="add">Add Cloth</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['cloth_id'] ?></td>
            <td><?= $row['cloth_name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['size'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>
                <a href="?delete=<?= $row['cloth_id'] ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

    <a class="back" href="admin_dashboard.php">← Back to Dashboard</a>

</div>

</body>
</html>