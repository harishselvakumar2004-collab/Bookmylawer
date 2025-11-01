<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Database connection
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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : 0;

    if ($userId > 0) {
        $sql = "SELECT id, first_name, last_name, email, phone, address, city, zip, profile_image, agreed 
                FROM user_profiles 
                WHERE user_id = $userId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $profile = $result->fetch_assoc(); // Only one profile per user
            echo json_encode(["success" => true, "data" => $profile]);
        } else {
            echo json_encode(["success" => true, "data" => null, "message" => "No profile found."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid or missing user ID."]);
    }

    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
