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

// POST request only
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get form data
    $userId    = $_POST['user_id'] ?? null;
    $firstName = $_POST['first_name'] ?? '';
    $lastName  = $_POST['last_name'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $address   = $_POST['address'] ?? '';
    $city      = $_POST['city'] ?? '';
    $zip       = $_POST['zip'] ?? '';
    $agreed    = isset($_POST['agreed']) ? 1 : 0;

    // Validate required fields
    if (
        empty($userId) || empty($firstName) || empty($lastName) || empty($email) ||
        empty($phone) || empty($address) || empty($city) || empty($zip)
    ) {
        echo json_encode(["success" => false, "message" => "All fields including user ID are required."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email address."]);
        exit;
    }

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
        echo json_encode(["success" => false, "message" => "Invalid phone number."]);
        exit;
    }

    if (!preg_match('/^[0-9]{6}$/', $zip)) {
        echo json_encode(["success" => false, "message" => "Invalid ZIP code."]);
        exit;
    }

    // Upload image
    $profileImage = "";
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = basename($_FILES['profile_image']['name']);
        $uniqueName = time() . "_" . $filename;
        $targetPath = $uploadDir . $uniqueName;

        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
            $profileImage = $targetPath;
        } else {
            echo json_encode(["success" => false, "message" => "Image upload failed."]);
            exit;
        }
    }

    // Insert user into database with user_id
    $stmt = $conn->prepare("INSERT INTO user_profiles 
        (user_id, first_name, last_name, email, phone, address, city, zip, profile_image, agreed)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issssssssi", 
        $userId, $firstName, $lastName, $email, $phone, $address, $city, $zip, $profileImage, $agreed);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "User profile created successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Database insert failed: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
