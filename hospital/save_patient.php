<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['patient-name'];
    $gender = $_POST['patient-gender'];
    $dob = $_POST['patient-dob']; // Ensure this is in YYYY-MM-DD format
    $phone = $_POST['patient-phone'];
    $address = $_POST['patient-address'];

    // Debug: Output received data
    echo "Received Data: Name=$name, Gender=$gender, DOB=$dob, Phone=$phone, Address=$address<br>";

    // Validate DOB format (optional, but recommended)
    if (!DateTime::createFromFormat('Y-m-d', $dob)) {
        echo "Error: Invalid DOB format. Please use YYYY-MM-DD.<br>";
        exit();
    }

    // Prepare SQL statement to insert data
    $sql = "INSERT INTO Patient (Name, Gender, DOB, Phone, Address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Prepare failed: " . $conn->error . "<br>";
        exit();
    }

    // Bind parameters (all strings, assuming Phone and Address are VARCHAR)
    $stmt->bind_param("sssss", $name, $gender, $dob, $phone, $address);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully!<br>";
        header("Location: index.php?message=Patient added successfully");
        exit();
    } else {
        echo "Execute failed: " . $stmt->error . "<br>";
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "No POST data received. Method: " . $_SERVER['REQUEST_METHOD'];
    exit();
}

// Close the connection
$conn->close();
?>