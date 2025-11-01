<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bookmylawyer";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Accept POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lawyer_id   = $_POST['lawyer_id'] ?? '';
    $first_name  = $_POST['first_name'] ?? '';
    $last_name   = $_POST['last_name'] ?? '';
    $email       = $_POST['email'] ?? '';
    $contact     = $_POST['contact'] ?? '';

    if (empty($lawyer_id) || empty($first_name) || empty($last_name) || empty($email) || empty($contact)) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "All fields are required."]);
        exit;
    }

    // Prepare update
    $sql = "UPDATE lawyers SET first_name = ?, last_name = ?, email = ?, contact = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ssssi", $first_name, $last_name, $email, $contact, $lawyer_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Lawyer profile updated successfully."]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Execute failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
