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
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Static keyword for Divorce lawyers
    $keyword = 'Divorce';

    // SQL to search in both columns
    $sql = "SELECT * FROM lawyers 
            WHERE LOWER(case_type) LIKE ? 
               OR LOWER(case_types) LIKE ?";

    $likeKeyword = '%' . strtolower($keyword) . '%';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $likeKeyword, $likeKeyword);
    $stmt->execute();
    $result = $stmt->get_result();

    $lawyers = [];
    while ($row = $result->fetch_assoc()) {
        $lawyers[] = $row;
    }

    if (count($lawyers) > 0) {
        echo json_encode(["success" => true, "data" => $lawyers]);
    } else {
        echo json_encode(["success" => false, "message" => "No divorce lawyers found."]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
