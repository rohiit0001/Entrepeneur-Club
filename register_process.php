<?php
require_once 'db_connect.php'; // Include database connection
require_once 'functions.php'; // Include helper functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $industry = $_POST['industry'];
    $bio = $_POST['bio'] ?? '';

    // Check if the email is already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email already exists, redirect back with an error
        header("Location: register.php?error=email_exists");
        exit();
    }

    $stmt->close();

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, industry, bio) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password, $industry, $bio);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        header("Location: login.php?success=1");
        exit();
    } else {
        // Handle registration failure
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>