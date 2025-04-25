<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "entrepreneurs_club";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Database connection error. Please try again later.");
}

// Set character set
$conn->set_charset("utf8mb4");
?>