<?php
include "db.php";

// DELETE recipient
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM Recipient WHERE recipient_id=$id");
}

// FETCH DATA
$data = mysqli_query($conn, "SELECT * FROM Recipient");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipient List</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .box {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 25px;
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

        .delete {
            color: red;
            text-decoration: none;
        }

        .back {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background: #444;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }

        .back:hover {
            background: #222;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Recipient List</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $row['recipient_id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td>
                <a class="delete" href="?delete=<?= $row['recipient_id'] ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>

    </table>

    <!-- BACK BUTTON -->
    <a href="admin_dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>