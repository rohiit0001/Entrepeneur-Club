<?php
// Database connection
require_once 'db_connect.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the event ID from the form
    $event_id = isset($_POST['event_id']) ? (int)$_POST['event_id'] : 0;

    // Fetch the event to delete the associated image
    $stmt = $conn->prepare("SELECT event_image FROM events WHERE id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();

    if ($event) {
        // Delete the event image if it exists
        if (!empty($event['event_image']) && file_exists($event['event_image'])) {
            unlink($event['event_image']);
        }

        // Delete the event from the database
        $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
        $stmt->bind_param("i", $event_id);

        if ($stmt->execute()) {
            // Redirect back to the events page with a success message
            header('Location: events.php?delete_success=1');
            exit();
        } else {
            die('Error deleting the event: ' . $stmt->error);
        }
    } else {
        die('Event not found.');
    }
}
?>