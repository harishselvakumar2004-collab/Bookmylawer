<?php
header("Content-Type: application/json");
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $booking_id = $_POST['booking_id'] ?? '';
    $status = $_POST['status'] ?? ''; // Should be 'Accepted' or 'Rejected'

    if (empty($booking_id) || empty($status)) {
        echo json_encode(["success" => false, "message" => "Missing booking_id or status."]);
        exit;
    }

    // Validate status
    $validStatuses = ['Accepted', 'Rejected'];
    if (!in_array($status, $validStatuses)) {
        echo json_encode(["success" => false, "message" => "Invalid status value."]);
        exit;
    }

    // Update status in DB
    $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $booking_id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Booking status updated to '$status'."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update booking status."]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["success" => false, "message" => "Only POST requests are allowed."]);
}
?>
