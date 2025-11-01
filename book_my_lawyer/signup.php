<?php

header("Content-Type: application/json");
include "config.php";

// Database connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Validation
    if (empty($full_name) || empty($email) || empty($password) || empty($confirm_password)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid email format."]);
        exit;
    }

    if ($password !== $confirm_password) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Passwords do not match."]);
        exit;
    }

    // Check for existing user
    $stmt = $conn->prepare("SELECT id FROM user_signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        http_response_code(409);
        echo json_encode(["success" => false, "message" => "Email already registered."]);
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO user_signup (name, email, password, plain_password, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $full_name, $email, $hashedPassword, $password);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Signup successful."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Signup failed. Please try again."]);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Only POST method is allowed."]);
}

$conn->close();
?>
