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

// Handle GET request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, case_section, punishment_details, suggested_lawyers FROM case_sections ORDER BY id DESC";
    $result = $conn->query($sql);

    $sections = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $sections[] = [
                "id" => $row["id"],
                "case_section" => $row["case_section"],
                "punishment_details" => $row["punishment_details"],
                "suggested_lawyers" => $row["suggested_lawyers"]
            ];
        }

        echo json_encode(["success" => true, "data" => $sections]);
    } else {
        echo json_encode(["success" => false, "message" => "No sections found."]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
