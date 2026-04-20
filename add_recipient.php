<?php
include "db.php";

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    $sql = "INSERT INTO Recipient (name, email, phone, age, gender)
            VALUES ('$name', '$email', '$phone', '$age', '$gender')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Recipient</title>

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
    </style>
</head>

<body>

<div class="box">

    <h2>Add Recipient</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="Phone">
        <input type="number" name="age" placeholder="Age">
        <input type="text" name="gender" placeholder="Gender">

        <button name="add">Add Recipient</button>
    </form>

    <br><br>

    <a href="admin_dashboard.php" style="
        display: block;
        padding: 10px;
        background: #444;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    ">
        ← Back to Dashboard
    </a>

</div>

</body>
</html>