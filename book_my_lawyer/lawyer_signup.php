<?php

header("Content-Type: application/json");
include "config.php";

// DB connection
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit;
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Basic validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
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

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM lawyer_signup WHERE email = ?");
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Database error."]);
        exit;
    }

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

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database (store both hashed and plain password)
    $stmt = $conn->prepare("INSERT INTO lawyer_signup (name, email, password, plain_password, created_at) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Failed to prepare statement."]);
        exit;
    }

    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $password);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(["success" => true, "message" => "Registration successful."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Registration failed. Try again."]);
    }

    $stmt->close();
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Only POST method allowed."]);
}

$conn->close();
?>
