<?php
$servername = "localhost";
$username = "root";  // Default user for XAMPP
$password = "";      // Default password is empty in XAMPP
$dbname = "crud_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
