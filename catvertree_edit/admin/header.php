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
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Admin - Cat System</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #eafcfc, #dff6f6);
}

.header {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    padding: 15px 40px;
    background: linear-gradient(90deg, #4fc3f7, #29b6f6);
    color: white;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.left-section {
    font-weight: 500;
}

.logo {
    text-align: center;
    font-size: 18px;
    font-weight: 600;
}

.right-section {
    text-align: right;
}

.right-section a {
    color: white;
    text-decoration: none;
    margin-left: 18px;
    font-size: 14px;
    transition: 0.3s;
}

.right-section a:hover {
    opacity: 0.8;
}
.form-wrapper {
    max-width: 600px;
    margin: 0 auto;
}

.container form {
    max-width: 650px;
    margin: 0 auto;
}

.container form input,
.container form textarea,
.container form select {
    width: 100%;
    padding: 12px 14px;
    font-size: 14px;
    border: none;
    border-bottom: 2px solid #dceff1;
    background: transparent;
    outline: none;
    margin-bottom: 28px;
    transition: 0.3s ease;
}

.container form textarea {
    resize: none;
    min-height: 100px;
}

.container form input:focus,
.container form textarea:focus,
.container form select:focus {
    border-bottom: 2px solid #4fb6c2;
    background: #f8fcfd;
}

.btn {
    background: #4fb6c2;
    padding: 10px 28px;
    border-radius: 50px;
    border: none;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: 0.3s;
}

.btn:hover {
    background: #3aa3b0;
    transform: translateY(-1px);
}
.btn,
.btn:link,
.btn:visited {
    display: inline-block;
    text-decoration: none;
    color: white;
}

/* CONTENT BOX */
.container {
    max-width: 1100px;
    margin: 50px auto;
    background: #ffffff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}



/* Responsive */
@media (max-width: 768px) {
    .header {
        grid-template-columns: 1fr;
        text-align: center;
        gap: 10px;
    }

    .right-section {
        text-align: center;
    }
}
</style>
</head>
<body>

<div class="header">

    <div class="left-section">
        👋 <?php echo $_SESSION['admin_name'] ?? ''; ?>
    </div>

    <div class="logo">
        🐱 Cat Admin 🐱
    </div>

    <div class="right-section">
        <a href="../index.php" target="_blank">หน้าเว็บไซต์หลัก</a>

        <a href="index.php"
           class="<?php if($current_page=='index.php') echo 'active-link'; ?>">
           Dashboard
        </a>

        <a href="profile.php"
           class="<?php if($current_page=='profile.php') echo 'active-link'; ?>">
           โปรไฟล์
        </a>

        <a href="logout.php">Logout</a>
    </div>

</div>

<div class="container">