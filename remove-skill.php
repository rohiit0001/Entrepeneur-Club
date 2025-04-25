<?php
// filepath: c:\xampp\htdocs\int219\remove-skill.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$skill_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$skill_id) {
    header("Location: profile.php");
    exit();
}

// Check if the skill is linked to the logged-in user
$stmt = $conn->prepare("SELECT id FROM user_skills WHERE user_id = ? AND skill_id = ?");
$stmt->bind_param("ii", $user_id, $skill_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows === 0) {
    header("Location: profile.php");
    exit();
}

// Remove the skill from the user's profile
$stmt = $conn->prepare("DELETE FROM user_skills WHERE user_id = ? AND skill_id = ?");
$stmt->bind_param("ii", $user_id, $skill_id);

if ($stmt->execute()) {
    header("Location: profile.php?message=skill_removed");
    exit();
} else {
    header("Location: profile.php?error=remove_failed");
    exit();
}

$stmt->close();
?>