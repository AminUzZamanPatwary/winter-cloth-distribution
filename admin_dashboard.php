<?php
session_start();

// protect admin page
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
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

        .danger {
            background: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Admin Dashboard</h2>

    <!-- CLOTH MANAGEMENT -->
    <a href="manage_clothes.php">Manage Clothes</a>

    <!-- REQUEST SYSTEM -->
    <a href="manage_requests.php">Manage Requests</a>

    <!-- DISTRIBUTION -->
    <a href="distribution.php">Distribute Clothes</a>

    <!-- SEARCH -->
    <a href="search_clothes.php">Search Clothes</a>

    <!-- REPORTS -->
    <a href="report.php">Reports</a>

    <!-- DONOR MANAGEMENT -->
    <a href="add_donor.php">Add Donor</a>
    <a href="view_donors.php">View Donors</a>

    <!-- RECIPIENT MANAGEMENT -->
    <a href="add_recipient.php">Add Recipient</a>
    <a href="view_recipients.php">View Recipients</a>

    <!-- LOGOUT -->
    <a class="danger" href="logout.php">Logout</a>

</div>

</body>
</html>