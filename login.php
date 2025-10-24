<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unique_id = $_POST["unique_id"];

    // Check if the user exists in the database
    $sql = "SELECT username FROM users WHERE unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $unique_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($username);
        $stmt->fetch();
        echo "<script>alert('Login successful! Welcome, $username'); window.location.href='dashboard.html';</script>";
    } else {
        echo "<script>alert('Invalid Unique ID. Try again.'); window.location.href='login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
