<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include "config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit;
}

// Fetch input values
$applicant = $_POST['applicant'] ?? '';
$response = $_POST['response'] ?? '';
$posted_by = $_POST['posted_by'] ?? '';
$lawyer_id = $_POST['lawyer_id'] ?? '';
$user_id = $_POST['user_id'] ?? '';

// Validate required fields
if (empty($applicant) || empty($response) || empty($posted_by) || empty($lawyer_id) || empty($user_id)) {
    echo json_encode(["success" => false, "message" => "All fields are required."]);
    exit;
}

// Handle file upload
$upload_dir = "uploads/";
$file_path = "";

if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_FILES['document']) && $_FILES['document']['error'] == 0) {
    $filename = basename($_FILES["document"]["name"]);
    $target_file = $upload_dir . time() . "_" . $filename;

    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
        $file_path = $target_file;
    } else {
        echo json_encode(["success" => false, "message" => "File upload failed."]);
        exit;
    }
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO case_responses (applicant, response_text, posted_by, document_path, lawyer_id, user_id) VALUES (?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssssss", $applicant, $response, $posted_by, $file_path, $lawyer_id, $user_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Response submitted successfully."]);
} else {
    echo json_encode(["success" => false, "message" => "Execute failed: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
