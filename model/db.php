<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "admin_db"; // ← replace with your DB name

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
