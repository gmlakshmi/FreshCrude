<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome to Farmer-Consumer Platform</h2>
    <p>Your Unique ID: <?php echo $_SESSION['unique_id']; ?></p>
    <div>
    <a href="front1.html" class="cta-btn">View Now</a>
</div>
</body>
</html>

