<?php
header("Content-Type: application/json");

include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $dateInput = $_POST['date'] ?? '';
    $date = date('Y-m-d', strtotime($dateInput));
    $time = $_POST['time'] ?? '';
    $section = $_POST['section'] ?? '';
    $case_details = $_POST['case_details'] ?? '';
    $user_id = $_POST['user_id'] ?? '';
    $lawyer_id = $_POST['lawyer_id'] ?? '';
    $status = "Pending"; // Default status

    // Upload PDF
    $pdf_path = "";
    if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['pdf_file']['tmp_name'];
        $filename = basename($_FILES['pdf_file']['name']);
        $targetDir = "uploads/";
        $uniqueName = uniqid() . "_" . $filename;
        $targetPath = $targetDir . $uniqueName;

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $targetPath)) {
            $pdf_path = $targetPath;
        } else {
            echo json_encode(["success" => false, "message" => "PDF upload failed."]);
            exit;
        }
    }

    // Insert into DB with user_id and lawyer_id and status
    $stmt = $conn->prepare("INSERT INTO bookings (name, date, time, section, case_details, pdf_file, user_id, lawyer_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiis", $name, $date, $time, $section, $case_details, $pdf_path, $user_id, $lawyer_id, $status);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Booking successful."]);
    } else {
        echo json_encode(["success" => false, "message" => "Database insert failed."]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode(["success" => false, "message" => "Only POST requests allowed."]);
}
?>
