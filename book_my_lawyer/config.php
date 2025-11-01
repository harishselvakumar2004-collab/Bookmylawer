<?php
header("Content-Type: application/json");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enables exception mode

try {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "bookmylawyer";

    // Create connection
    $conn = new mysqli($host, $user, $pass, $dbname);

    // Optional: Set charset
    $conn->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    $data = [
        "status" => 500,
        "message" => "Database connection error: " . $e->getMessage()
    ];
    http_response_code(500);
    echo json_encode($data);
    exit;
}
?>
