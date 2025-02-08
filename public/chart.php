<?php
include '../config/database.php';

// count the users based on gender
$sql = "SELECT gender, COUNT(*) AS count FROM users GROUP BY gender";
$result = $conn->query($sql);

$genders = [];
$counts = [];

while ($row = $result->fetch_assoc()) {
    $genders[] = $row['gender'];
    $counts[] = $row['count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gender Distribution</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">PHP CRUD Application</a>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center">Gender Distribution of Users</h2>
    <canvas id="genderChart" style="width: 60%; height: 300px; margin: auto;"></canvas>
</div>

<script>
    
    const genderLabels = <?= json_encode($genders) ?>;
    const genderCounts = <?= json_encode($counts) ?>;

    
    const genderColors = {
        'Male': 'rgba(54, 162, 235, 0.6)',      
        'Female': 'rgba(255, 99, 132, 0.6)',    
        'Other': 'rgba(255, 159, 64, 0.6)'      
    };

    
    const colors = genderLabels.map(gender => genderColors[gender] || 'rgba(75, 192, 192, 0.6)');

    // Data for the chart
    const data = {
        labels: genderLabels,
        datasets: [{
            label: 'Number of Users',
            data: genderCounts,
            backgroundColor: colors,
            borderColor: colors.map(color => color.replace('0.6', '1')),  
            borderWidth: 1
        }]
    };

    // Chart configuration
    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    
    new Chart(document.getElementById('genderChart'), config);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
