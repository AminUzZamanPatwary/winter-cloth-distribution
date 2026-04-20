<?php
include "db.php";

// HANDLE DISTRIBUTION ACTION
if(isset($_GET['distribute'])){
    $request_id = $_GET['distribute'];

    // Get request details
    $req = mysqli_query($conn, "
        SELECT * FROM Request WHERE request_id=$request_id
    ");

    $r = mysqli_fetch_assoc($req);

    $cloth_id = $r['cloth_id'];
    $recipient_id = $r['recipient_id'];

    // Reduce cloth quantity by 1 (you can change logic later)
    mysqli_query($conn, "
        UPDATE Cloth 
        SET quantity = quantity - 1 
        WHERE cloth_id=$cloth_id AND quantity > 0
    ");

    // Insert into Distribution table
    mysqli_query($conn, "
        INSERT INTO Distribution (cloth_id, recipient_id, quantity, staff_id)
        VALUES ($cloth_id, $recipient_id, 1, 1)
    ");

    // Optional: mark request as completed
    mysqli_query($conn, "
        UPDATE Request 
        SET status='Distributed' 
        WHERE request_id=$request_id
    ");
}

// SHOW ONLY APPROVED REQUESTS
$sql = "
SELECT 
    Request.request_id,
    Cloth.cloth_name,
    Recipient.name AS recipient_name,
    Cloth.quantity
FROM Request
JOIN Cloth ON Request.cloth_id = Cloth.cloth_id
JOIN Recipient ON Request.recipient_id = Recipient.recipient_id
WHERE Request.status = 'Approved'
";

$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Distribution</title>

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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        a {
            text-decoration: none;
            padding: 6px 10px;
            background: green;
            color: white;
            border-radius: 4px;
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

    <h2>Distribution System</h2>

    <table>
        <tr>
            <th>Request ID</th>
            <th>Cloth</th>
            <th>Recipient</th>
            <th>Available Qty</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['request_id'] ?></td>
            <td><?= $row['cloth_name'] ?></td>
            <td><?= $row['recipient_name'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td>
                <a href="?distribute=<?= $row['request_id'] ?>">Distribute</a>
            </td>
        </tr>
        <?php } ?>

    </table>

    <a class="back" href="admin_dashboard.php">← Back to Dashboard</a>

</div>

</body>
</html>