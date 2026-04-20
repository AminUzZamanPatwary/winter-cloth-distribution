<?php
include "db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Clothes</title>

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
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
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

<div class="container">

    <h2>Search Clothes</h2>

    <form method="POST">
        <input type="text" name="k" placeholder="Enter cloth name..." required>
        <button name="s">Search</button>
    </form>

    <?php
    if(isset($_POST['s'])){
        $k = $_POST['k'];

        $q = "
        SELECT c.*,
        (
            SELECT IFNULL(SUM(quantity),0)
            FROM Distribution d 
            WHERE d.cloth_id = c.cloth_id
        ) AS total_distributed
        FROM Cloth c
        WHERE c.cloth_name LIKE '%$k%'
        ";

        $res = mysqli_query($conn, $q);
    ?>

    <table>
        <tr>
            <th>Cloth Name</th>
            <th>Type</th>
            <th>Size</th>
            <th>Available Qty</th>
            <th>Total Distributed</th>
        </tr>

        <?php while($r = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?= $r['cloth_name'] ?></td>
            <td><?= $r['type'] ?></td>
            <td><?= $r['size'] ?></td>
            <td><?= $r['quantity'] ?></td>
            <td><?= $r['total_distributed'] ?></td>
        </tr>
        <?php } ?>

    </table>

    <?php } ?>

    <!-- BACK BUTTON -->
    <a href="admin_dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>