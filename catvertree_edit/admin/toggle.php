<?php
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


$id = intval($_GET['id']);

$result = $conn->query("SELECT is_visible FROM cats_edit WHERE id=$id");
$row = $result->fetch_assoc();

$newStatus = $row['is_visible'] ? 0 : 1;

$conn->query("UPDATE cats_edit SET is_visible=$newStatus WHERE id=$id");

header("Location: index.php");
?>
