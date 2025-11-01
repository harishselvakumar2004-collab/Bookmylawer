<?php
ob_clean(); 

header("Content-Type: application/json");
include "config.php"; // assumes $conn is defined inside

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Get lawyer_id from query string
    $lawyer_id = $_GET['lawyer_id'] ?? '';

    if (empty($lawyer_id)) {
        echo json_encode(["success" => false, "message" => "Missing lawyer_id."]);
        exit;
    }

    // Select only pending bookings for the specific lawyer
    $sql = "SELECT id, name, date, time, section, case_details, pdf_file, status 
            FROM bookings 
            WHERE lawyer_id = ? AND status = 'Pending' 
            ORDER BY id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $lawyer_id);
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
                "pdf_url" => $row["pdf_file"] // Optional: Add domain name here
            ];
        }

        echo json_encode(["success" => true, "data" => $bookings]);
    } else {
        echo json_encode(["success" => false, "message" => "No pending bookings found."]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
