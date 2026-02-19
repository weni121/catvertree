<?php
$host = "localhost";
$username = "it67040233121";     
$password = "R1X8V3T6";      
$dbname = "it67040233121";    


$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>