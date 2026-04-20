<?php
include "db.php";

/* =========================
   SUMMARY COUNTS
========================= */

// total cloth items
$cloth = mysqli_query($conn, "SELECT COUNT(*) as total FROM Cloth");
$cloth_count = mysqli_fetch_assoc($cloth)['total'];

// total donations
$donation = mysqli_query($conn, "SELECT SUM(quantity) as total FROM Donation");
$donation_count = mysqli_fetch_assoc($donation)['total'];

// total requests
$request = mysqli_query($conn, "SELECT COUNT(*) as total FROM Request");
$request_count = mysqli_fetch_assoc($request)['total'];

// total distributions
$dist = mysqli_query($conn, "SELECT SUM(quantity) as total FROM Distribution");
$dist_count = mysqli_fetch_assoc($dist)['total'];


/* =========================
   ADVANCED JOIN REPORT
========================= */

$sql = "
SELECT 
    Cloth.cloth_name,
    SUM(Distribution.quantity) as total_given
FROM Distribution
JOIN Cloth ON Distribution.cloth_id = Cloth.cloth_id
GROUP BY Cloth.cloth_name
";

$report = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reports</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        .box {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .card {
            background: #2a5298;
            color: white;
            padding: 15px;
            border-radius: 6px;
            width: 20%;
            text-align: center;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #2a5298;
            color: white;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #2a5298;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>System Reports</h2>

    <!-- SUMMARY -->
    <div class="box">

        <div class="card">
            <h3><?= $cloth_count ?></h3>
            <p>Total Cloth</p>
        </div>

        <div class="card">
            <h3><?= $donation_count ?></h3>
            <p>Total Donated</p>
        </div>

        <div class="card">
            <h3><?= $request_count ?></h3>
            <p>Total Requests</p>
        </div>

        <div class="card">
            <h3><?= $dist_count ?></h3>
            <p>Total Distributed</p>
        </div>

    </div>

    <!-- DETAILED REPORT -->
    <h3 style="margin-top:30px; text-align:center;">Distribution Summary (JOIN + GROUP BY)</h3>

    <table>
        <tr>
            <th>Cloth Name</th>
            <th>Total Given</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($report)) { ?>
        <tr>
            <td><?= $row['cloth_name'] ?></td>
            <td><?= $row['total_given'] ?></td>
        </tr>
        <?php } ?>

    </table>

    <a class="back" href="admin_dashboard.php">← Back to Dashboard</a>

</div>

</body>
</html>