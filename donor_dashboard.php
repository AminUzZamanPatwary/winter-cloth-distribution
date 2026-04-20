<?php
include "db.php";
session_start();

if(!isset($_SESSION['donor_id'])){
    header("Location: donor_login.php");
    exit();
}

$donor_id = $_SESSION['donor_id'];
$name = $_SESSION['donor_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .box {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px;
        }

        a {
            display: block;
            padding: 10px;
            margin-top: 10px;
            background: #2a5298;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Welcome, <?= $name ?></h2>

    <a href="add_donation.php">Donate Clothes</a>
    <a href="logout.php">Logout</a>

</div>

</body>
</html>