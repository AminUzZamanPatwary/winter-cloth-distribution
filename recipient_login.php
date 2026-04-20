<?php
include "db.php";
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];

    // Since your Recipient table has NO password column
    $sql = "SELECT * FROM Recipient WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1){
        $row = mysqli_fetch_assoc($res);

        $_SESSION['recipient_id'] = $row['recipient_id'];
        $_SESSION['recipient_name'] = $row['name'];

        header("Location: recipient_dashboard.php");
        exit();
    } else {
        $error = "Recipient not found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recipient Login</title>

    <style>
        body {
            font-family: Arial;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            width: 320px;
            background: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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

        .error {
            color: red;
            margin-top: 10px;
        }

        .back {
            display: block;
            margin-top: 15px;
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

<div class="box">

    <h2>Recipient Login</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <button name="login">Login</button>
    </form>

    <!-- BACK TO HOME -->
    <a href="index.php" class="back">← Back to Home</a>

</div>

</body>
</html>