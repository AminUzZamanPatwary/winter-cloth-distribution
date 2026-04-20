<?php
include "db.php";

// UPDATE STATUS
if(isset($_GET['action'])){
    $id = $_GET['id'];
    $action = $_GET['action'];

    if($action == "approve"){
        mysqli_query($conn, "UPDATE Request SET status='Approved' WHERE request_id=$id");
    }

    if($action == "reject"){
        mysqli_query($conn, "UPDATE Request SET status='Rejected' WHERE request_id=$id");
    }
}

// JOIN QUERY (IMPORTANT PART)
$sql = "
SELECT 
    Request.request_id,
    Cloth.cloth_name,
    Recipient.name AS recipient_name,
    Request.status
FROM Request
JOIN Cloth ON Request.cloth_id = Cloth.cloth_id
JOIN Recipient ON Request.recipient_id = Recipient.recipient_id
";

$data = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Requests</title>

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
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
        }

        .approve {
            background: green;
        }

        .reject {
            background: red;
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

    <h2>Manage Requests</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Cloth</th>
            <th>Recipient</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['request_id'] ?></td>
            <td><?= $row['cloth_name'] ?></td>
            <td><?= $row['recipient_name'] ?></td>
            <td><?= $row['status'] ?></td>
            <td>
                <a class="approve" href="?action=approve&id=<?= $row['request_id'] ?>">Approve</a>
                <a class="reject" href="?action=reject&id=<?= $row['request_id'] ?>">Reject</a>
            </td>
        </tr>
        <?php } ?>

    </table>

    <a class="back" href="admin_dashboard.php">← Back to Dashboard</a>

</div>

</body>
</html>