<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include "config.php";

// Get user_id from URL
$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode(["success" => false, "message" => "Missing user_id"]);
    exit;
}

// Prepare SQL to get responses by user_id
$sql = "SELECT id, applicant, response_text, posted_by, document_path, lawyer_id, user_id, created_at 
        FROM case_responses 
        WHERE user_id = ? 
        ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "SQL prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$responses = [];
while ($row = $result->fetch_assoc()) {
    $responses[] = $row;
}

echo json_encode(["success" => true, "data" => $responses]);

$stmt->close();
$conn->close();
?>
