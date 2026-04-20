<?php
include "db.php";
session_start();

$error = "";

if(isset($_POST['login'])){
    $e = $_POST['email'];
    $p = $_POST['password'];

    $q = "SELECT * FROM Admin WHERE email='$e' AND password='$p'";
    $r = mysqli_query($conn, $q);

    if(mysqli_num_rows($r) == 1){
        $_SESSION['admin'] = $e;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f5f7fa;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 320px;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #1e3c72;
        }

        .back {
            display: block;
            margin-top: 12px;
            text-decoration: none;
            color: #2a5298;
            font-size: 14px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="login-box">
    <h2>Admin Login</h2>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <?php if($error != "") echo "<div class='error'>$error</div>"; ?>

    <a class="back" href="index.php">← Back to Home</a>
</div>

</body>
</html>