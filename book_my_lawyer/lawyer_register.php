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
    echo json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]);
    exit;
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form fields
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $caseTypes = isset($_POST['case_types']) ? implode(", ", $_POST['case_types']) : '';
    
    $university = trim($_POST['university'] ?? '');
    $degree = trim($_POST['degree'] ?? '');
    $year = trim($_POST['year'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $zip = trim($_POST['zip'] ?? '');
    $caseType = trim($_POST['case_type'] ?? '');
    $fee = trim($_POST['fee'] ?? '');

    // ====== Validation ======
    $errors = [];

    if (empty($firstName)) $errors[] = "First name is required.";
    if (empty($lastName)) $errors[] = "Last name is required.";
    if (empty($contact) || !preg_match('/^\d{10}$/', $contact)) $errors[] = "Valid 10-digit contact number required.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($caseTypes)) $errors[] = "At least one case type is required.";

    if (empty($university)) $errors[] = "University is required.";
    if (empty($degree)) $errors[] = "Degree is required.";
    if (empty($year) || !is_numeric($year) || $year < 1950 || $year > date("Y")) $errors[] = "Valid passing year is required.";
    if (empty($address)) $errors[] = "Address is required.";
    if (empty($city)) $errors[] = "City is required.";
    if (empty($zip) || !preg_match('/^\d{6}$/', $zip)) $errors[] = "Valid 6-digit ZIP code is required.";
    if (empty($caseType)) $errors[] = "Specialized case type is required.";
    if (empty($fee) || !is_numeric($fee)) $errors[] = "Valid fee is required.";

    if (!empty($errors)) {
        http_response_code(422); // Unprocessable Entity
        echo json_encode(["success" => false, "errors" => $errors]);
        exit;
    }

    // ===== Duplicate Check =====
    $checkSql = "SELECT id FROM lawyers WHERE email = ? OR contact = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $email, $contact);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        http_response_code(409); // Conflict
        echo json_encode(["success" => false, "message" => "A lawyer with the same email or contact already exists."]);
        $checkStmt->close();
        $conn->close();
        exit;
    }
    $checkStmt->close();

    // ===== File Upload =====
    $filePath = "";
    $uploadDir = "uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!empty($_FILES['casefile']['name'])) {
        $fileName = basename($_FILES['casefile']['name']);
        $targetFile = $uploadDir . time() . "_" . $fileName;
        if (move_uploaded_file($_FILES['casefile']['tmp_name'], $targetFile)) {
            $filePath = $targetFile;
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "File upload failed"]);
            exit;
        }
    }

    // ===== Insert into DB =====
    $sql = "INSERT INTO lawyers 
        (first_name, last_name, contact, email, case_types, casefile, university, degree, year, address, city, zip, case_type, fee)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "SQL prepare failed: " . $conn->error]);
        exit;
    }

    $stmt->bind_param("ssssssssssssss", $firstName, $lastName, $contact, $email, $caseTypes, $filePath,
        $university, $degree, $year, $address, $city, $zip, $caseType, $fee);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Registration successful"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Execute failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
