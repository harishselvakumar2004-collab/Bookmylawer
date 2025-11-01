<?php
header("Content-Type: application/json");

// DB Config
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bookmylawyer";

include "config.php";
$conn = new mysqli($host, $user, $pass, $dbname);

// Check DB connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Get POST values
$case_section = isset($_POST['case_section']) ? trim($_POST['case_section']) : '';
$punishment_details = isset($_POST['punishment_details']) ? trim($_POST['punishment_details']) : '';
$suggested_lawyers = isset($_POST['suggested_lawyers']) ? trim($_POST['suggested_lawyers']) : '';

// Check required fields
if (empty($case_section) || empty($punishment_details)) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Required fields are missing"]);
    exit;
}

// ✅ Check if case_section already exists
$checkStmt = $conn->prepare("SELECT id FROM case_sections WHERE case_section = ?");
$checkStmt->bind_param("s", $case_section);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    http_response_code(409); // Conflict
    echo json_encode(["success" => false, "message" => "Section already exists"]);
    $checkStmt->close();
    $conn->close();
    exit;
}
$checkStmt->close();

// Insert new section
$insertStmt = $conn->prepare("INSERT INTO case_sections (case_section, punishment_details, suggested_lawyers) VALUES (?, ?, ?)");
$insertStmt->bind_param("sss", $case_section, $punishment_details, $suggested_lawyers);

if ($insertStmt->execute()) {
    echo json_encode(["success" => true, "message" => "Section inserted successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Failed to insert section"]);
}

$insertStmt->close();
$conn->close();
?>
