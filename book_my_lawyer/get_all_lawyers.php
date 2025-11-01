<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Database connection
$host = "localhost";
$user = "root";
$pass = ""; // Change this to your actual DB password
$dbname = "bookmylawyer";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

// SQL query
$sql = "SELECT `id`, `first_name`, `last_name`, `contact`, `email`, `case_types`, `casefile`, `university`, `degree`, `year`, `address`, `city`, `zip`, `case_type`, `fee`, `created_at` FROM `lawyers`";
$result = $conn->query($sql);

// Prepare response
$lawyers = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lawyers[] = $row;
    }

    echo json_encode([
        "success" => true,
        "message" => "Lawyers fetched successfully",
        "data" => $lawyers
    ]);
} else {
    echo json_encode([
        "success" => true,
        "message" => "No lawyers found",
        "data" => []
    ]);
}

$conn->close();
?>
