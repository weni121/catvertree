<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);

if (!isset($_SESSION['admin_id']) 
    && $current_page != 'login.php' 
    && $current_page != 'check_login.php') {

    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin - Cat System</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #ccfffb, #ccfffc);
        }

        .header {
            background: linear-gradient(45deg, #02c1b7, #00b3aa);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
        }

        .footer {
            text-align: center;
            padding: 15px;
            background: #00b3aa;
            color: white;
            margin-top: 40px;
        }

        .container {
            padding: 30px;
            min-height: 70vh;
            background: white;
            margin: 30px auto;
            width: 90%;
            max-width: 1100px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1, h2 {
            text-align: center;
            padding: 20px;
            color: #036c8c;
        }

        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: linear-gradient(45deg, #99fff0, #02c1b7);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>

</head>
<body>

<div class="header">
    <div><strong>🐱 Cat Admin System</strong></div>
    <div>
        <?php if(isset($_SESSION['admin_name'])): ?>
            Welcome <?php echo $_SESSION['admin_name']; ?>
            <a href="index.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</div>

<div class="container">
