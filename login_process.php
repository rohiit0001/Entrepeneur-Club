<?php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check if the email exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, log the user in
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.php");
            exit();
        } else {
            // Password is incorrect
            header("Location: login.php?error=incorrect_password");
            exit();
        }
    } else {
        // Email does not exist
        header("Location: login.php?error=email_not_found");
        exit();
    }
}
?>