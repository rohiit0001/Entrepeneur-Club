<?php
// filepath: c:\xampp\htdocs\int219\register_event.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$event_id = $_GET['event_id'] ?? null;

if ($event_id) {
    // Check if the user is already registered for the event
    $stmt = $conn->prepare("SELECT id FROM event_attendees WHERE event_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $event_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User already registered
        header("Location: my-events.php?error=already_registered");
        exit();
    }

    $stmt->close();

    // Register the user for the event
    $stmt = $conn->prepare("INSERT INTO event_attendees (event_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $event_id, $user_id);

    if ($stmt->execute()) {
        // Registration successful
        header("Location: my-events.php?success=registered");
        exit();
    } else {
        // Registration failed
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>