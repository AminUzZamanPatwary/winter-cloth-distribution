<?php
include "db.php";
session_start();

// protect page
if(!isset($_SESSION['donor_id'])){
    header("Location: donor_login.php");
    exit();
}

if(isset($_POST['donate'])){
    $name = $_POST['cloth_name'];
    $type = $_POST['type'];
    $size = $_POST['size'];
    $qty  = $_POST['quantity'];

    // insert into Cloth table
    $sql = "INSERT INTO Cloth (cloth_name, type, size, quantity)
            VALUES ('$name', '$type', '$size', '$qty')";

    mysqli_query($conn, $sql);

    $msg = "Donation added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donate Clothes</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .box {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }

        button {
            background: #2a5298;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #1e3c72;
        }

        .msg {
            color: green;
            margin-top: 10px;
        }

        .back {
            display: block;
            margin-top: 15px;
            padding: 10px;
            background: #444;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .back:hover {
            background: #222;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Donate Clothes</h2>

    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">
        <input type="text" name="cloth_name" placeholder="Cloth Name" required>
        <input type="text" name="type" placeholder="Type (e.g. Jacket)">
        <input type="text" name="size" placeholder="Size (S/M/L)">
        <input type="number" name="quantity" placeholder="Quantity" required>

        <button name="donate">Donate</button>
    </form>

    <a href="donor_dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>