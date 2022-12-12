<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "blood_bank";
$port = "3355";

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
