
<?php
include "db.php";
session_start();

// protect page
if(!isset($_SESSION['recipient_id'])){
    header("Location: recipient_login.php");
    exit();
}

$recipient_id = $_SESSION['recipient_id'];
$name = $_SESSION['recipient_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipient Dashboard</title>

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
            padding: 25px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        a {
            display: block;
            margin: 10px 0;
            padding: 12px;
            background: #2a5298;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout {
            background: red;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Welcome, <?= $name ?></h2>

    <a href="request_cloth.php">Request Cloth</a>
    <a href="logout.php" class="logout">Logout</a>

</div>

</body>
</html>