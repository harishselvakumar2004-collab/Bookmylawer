<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// DB Config
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "bookmylawyer";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Fetch all case sections
$sql = "SELECT id, case_section, punishment_details, suggested_lawyers FROM case_sections ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sections = [];

    while ($row = $result->fetch_assoc()) {
        $sections[] = $row;
    }

    echo json_encode([
        "success" => true,
        "message" => "Sections retrieved successfully",
        "data" => $sections
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "No sections found"
    ]);
}

$conn->close();
?>
