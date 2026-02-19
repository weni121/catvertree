<?php
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


$id = $_GET['id'];

$conn->query("DELETE FROM cats_edit WHERE id=$id");

header("Location: index.php");
?>
