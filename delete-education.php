<?php
// filepath: c:\xampp\htdocs\int219\delete-education.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$education_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$education_id) {
    header("Location: profile.php");
    exit();
}

// Check if the education record belongs to the logged-in user
$stmt = $conn->prepare("SELECT school_logo FROM user_education WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $education_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$education = $result->fetch_assoc();
$stmt->close();

if (!$education) {
    header("Location: profile.php");
    exit();
}

// Delete the school logo file if it exists
if (!empty($education['school_logo']) && file_exists($education['school_logo'])) {
    unlink($education['school_logo']);
}

// Delete the education record from the database
$stmt = $conn->prepare("DELETE FROM user_education WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $education_id, $user_id);

if ($stmt->execute()) {
    header("Location: profile.php?message=education_deleted");
    exit();
} else {
    header("Location: profile.php?error=delete_failed");
    exit();
}

$stmt->close();
?>