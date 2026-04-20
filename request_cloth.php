<?php
include "db.php";
session_start();

// protect page
if(!isset($_SESSION['recipient_id'])){
    header("Location: recipient_login.php");
    exit();
}

$recipient_id = $_SESSION['recipient_id'];

// HANDLE REQUEST
if(isset($_POST['request'])){
    $cloth_id = $_POST['cloth_id'];

    mysqli_query($conn, "
        INSERT INTO Request (cloth_id, recipient_id, status)
        VALUES ($cloth_id, $recipient_id, 'Pending')
    ");

    $msg = "Request sent successfully!";
}

// FETCH CLOTH
$cloth = mysqli_query($conn, "SELECT * FROM Cloth");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Cloth</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        select, button {
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
            margin-top: 20px;
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

<div class="container">

    <h2>Request Cloth</h2>

    <?php if(isset($msg)) echo "<p class='msg'>$msg</p>"; ?>

    <form method="POST">
        <select name="cloth_id" required>
            <option value="">Select Cloth</option>

            <?php while($row = mysqli_fetch_assoc($cloth)) { ?>
                <option value="<?= $row['cloth_id'] ?>">
                    <?= $row['cloth_name'] ?> (<?= $row['quantity'] ?> available)
                </option>
            <?php } ?>

        </select>

        <button name="request">Send Request</button>
    </form>

    <!-- BACK BUTTON -->
    <a href="recipient_dashboard.php" class="back">← Back to Dashboard</a>

</div>

</body>
</html>