<?php
include 'db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Generate a unique ID
    $unique_id = 'ID-' . substr(md5(uniqid(rand(), true)), 0, 8);

    // Enable error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Email already registered!"]);
    } else {
        // Insert user into database
        $sql = "INSERT INTO users (username, email, unique_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $unique_id);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "unique_id" => $unique_id]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error: " . $stmt->error]);
        }
    }

    $stmt->close();
    $conn->close();
}
?>
