<?php
ob_clean();
header("Content-Type: application/json");
include "config.php"; // $conn should be defined here

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get user_id from query parameters
    $user_id = $_GET['user_id'] ?? '';

    if (empty($user_id)) {
        echo json_encode(["success" => false, "message" => "Missing user_id."]);
        exit;
    }

    // Fetch all bookings for this user
    $sql = "SELECT id, name, date, time, section, case_details, pdf_file, status 
            FROM bookings 
            WHERE user_id = ? 
            ORDER BY id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $bookings = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bookings[] = [
                "id" => $row["id"],
                "name" => $row["name"],
                "date" => $row["date"],
                "time" => $row["time"],
                "section" => $row["section"],
                "case_details" => $row["case_details"],
                "status" => $row["status"],
                "pdf_url" => $row["pdf_file"] // Add domain prefix if needed
            ];
        }

        echo json_encode(["success" => true, "data" => $bookings]);
    } else {
        echo json_encode(["success" => false, "message" => "No bookings found for this user."]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
