<?php
session_start();
include '../config.php';
include 'header.php'; 

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admins WHERE username=? AND password=?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $row = $result->fetch_assoc();

    $_SESSION['admin_id'] = $row['id'];
    $_SESSION['admin_name'] = $row['name'];

    header("Location: index.php");
    exit();

} else {
    echo "Login Failed";
}
include 'footer.php';
?>
