<?php
// Display errors for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database connection
$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_database_user';
$pass = 'your_database_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo "Database error: " . $e->getMessage();
    exit;
}

// Get form data
$name    = $_POST['patient-name'] ?? '';
$gender  = $_POST['patient-gender'] ?? '';
$dob     = $_POST['patient-dob'] ?? '';
$phone   = $_POST['patient-phone'] ?? '';
$address = $_POST['patient-address'] ?? '';

// Basic validation
if (!$name || !$gender || !$dob || !$phone || !$address) {
    echo "Please fill all fields.";
    exit;
}

// Insert into database
try {
    $stmt = $pdo->prepare("INSERT INTO patients (full_name, gender, date_of_birth, phone, address)
                           VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $gender, $dob, $phone, $address]);

    echo "Patient '$name' saved successfully.";
} catch (PDOException $e) {
    echo "Failed to save patient: " . $e->getMessage();
}
?>
