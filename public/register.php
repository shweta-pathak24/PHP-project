<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color:rgb(247, 241, 247);
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
        input:invalid {
            border-color: red;
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
        <div class="card-header bg-primary text-white text-center">
            <i class="bi bi-person-plus"></i> Register New User
        </div>
        <div class="card-body">
            <form action="../actions/register_user.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone Number:</label>
                    <input type="tel" name="phone" pattern="\d{10}" title="Enter exactly 10 digits" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address:</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gender:</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Register
                    </button>
                    <a href="index.php" class="btn btn-secondary">
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
