<?php
include '../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid ID.");
}

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
                                                                        
if (!$user) {
    die("User not found.");
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if (!empty($name) && !empty($phone) && !empty($email) && !empty($address) && !empty($gender)) {
        $sql = "UPDATE users SET name=?, phone=?, email=?, address=?, gender=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $name, $phone, $email, $address, $gender, $id);
        if ($stmt->execute()) {
            $success = "User updated successfully!";
        } else {
            $error = "Failed to update user.";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .card-header {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .btn {
            transition: all 0.3s ease-in-out;
        }
        .btn:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand mx-auto" href="index.php">PHP CRUD Application</a>
    </div>
</nav>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark text-center">
            <i class="bi bi-pencil-square"></i> Update User
        </div>
        <div class="card-body">
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input type="tel" name="phone" class="form-control" pattern="\d{10}" title="Enter exactly 10 digits" value="<?= htmlspecialchars($user['phone']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <textarea name="address" class="form-control" required><?= htmlspecialchars($user['address']) ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" <?= $user['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $user['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                        <option value="Other" <?= $user['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                     
                    <button type="submit" class="btn btn-success"> 
                        <i class="bi bi-check-circle"></i> Update User 
                    </button>
                    <a href="index.php" class="btn btn-secondary ">
                        <i class="bi bi-arrow-left"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
