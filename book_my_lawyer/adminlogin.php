<?php
header("Content-Type: application/json");
include "config.php";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed."]));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        echo json_encode(["success" => false, "message" => "Email and password required."]);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, email, password FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Invalid email or password."]);
        exit;
    }

    $stmt->bind_result($id, $email, $hashedPassword);
    $stmt->fetch();

    if ($password == $hashedPassword) {
        echo json_encode([
            "success" => true,
            "message" => "Login successful.",
            "id" => $id,
        ]);
    } else {
        echo json_encode(["success" => false, "message" => "Incorrect password."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Only POST method allowed."]);
}
?>
