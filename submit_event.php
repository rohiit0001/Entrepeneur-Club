<?php
// Database connection
require_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $event_name = htmlspecialchars(trim($_POST['event_name']));
    $event_type = htmlspecialchars(trim($_POST['event_type']));
    $event_date = htmlspecialchars(trim($_POST['event_date']));
    $event_time = htmlspecialchars(trim($_POST['event_time']));
    $event_location = htmlspecialchars(trim($_POST['event_location']));
    $event_description = htmlspecialchars(trim($_POST['event_description']));
    $organizer_name = htmlspecialchars(trim($_POST['organizer_name']));
    $organizer_email = htmlspecialchars(trim($_POST['organizer_email']));

    // Handle file upload
    $event_image = null;
    if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        $file_name = basename($_FILES['event_image']['name']);
        $file_tmp = $_FILES['event_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file type
        if (in_array($file_ext, $allowed_extensions)) {
            // Generate a unique file name
            $event_image = $upload_dir . uniqid('event_', true) . '.' . $file_ext;

            // Move the uploaded file to the uploads directory
            if (!move_uploaded_file($file_tmp, $event_image)) {
                die('Error uploading the file.');
            }
        } else {
            die('Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.');
        }
    }

    // Insert event details into the database
    $stmt = $conn->prepare("INSERT INTO events (event_name, event_type, event_date, event_time, event_location, event_description, event_image, organizer_name, organizer_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $event_name, $event_type, $event_date, $event_time, $event_location, $event_description, $event_image, $organizer_name, $organizer_email);

    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header('Location: events.php?success=1');
        exit();
    } else {
        die('Error saving the event: ' . $stmt->error);
    }
}
?>