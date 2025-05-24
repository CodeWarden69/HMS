<?php
$host = 'localhost'; // XAMPP default host
$username = 'root';  // XAMPP default username (adjust if you’ve set a different one)
$password = '';      // XAMPP default password (empty by default, adjust if needed)
$database = 'hospital_db1'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
