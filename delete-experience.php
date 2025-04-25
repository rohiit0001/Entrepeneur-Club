<?php
// filepath: c:\xampp\htdocs\int219\delete-experience.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$experience_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$experience_id) {
    header("Location: profile.php");
    exit();
}

// Check if the experience belongs to the logged-in user
$stmt = $conn->prepare("SELECT company_logo FROM user_experience WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $experience_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$experience = $result->fetch_assoc();
$stmt->close();

if (!$experience) {
    header("Location: profile.php");
    exit();
}

// Delete the company logo file if it exists
if (!empty($experience['company_logo']) && file_exists($experience['company_logo'])) {
    unlink($experience['company_logo']);
}

// Delete the experience from the database
$stmt = $conn->prepare("DELETE FROM user_experience WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $experience_id, $user_id);

if ($stmt->execute()) {
    header("Location: profile.php?message=experience_deleted");
    exit();
} else {
    header("Location: profile.php?error=delete_failed");
    exit();
}

$stmt->close();
?>