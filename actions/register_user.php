<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];                                   
    $gender = $_POST['gender'];
                                                                        
    if (!empty($name) && !empty($phone) && !empty($email) && !empty($address) && !empty($gender)) {
        $stmt = $conn->prepare("INSERT INTO users (name, phone, email, address, gender) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $phone, $email, $address, $gender);
        if ($stmt->execute()) {
            header("Location: ../public/index.php");
        } else {
            echo "Error registering user.";
        }
    } else {
        echo "All fields are required!";  
    }
}
?>

