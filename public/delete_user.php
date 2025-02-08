<?php
include '../config/database.php';
$id = $_GET['id'];

if ($conn->query("DELETE FROM users WHERE id=$id")) {
    header("Location: ../public/index.php");
} else {
    echo "Error deleting user.";
}
?>
