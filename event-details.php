<?php
// Database connection
require_once 'db_connect.php';

// Get the event ID from the URL
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the event details from the database
$stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();

// If the event is not found, show an error message
if (!$event) {
    die('Event not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($event['event_name']); ?> - Event Details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="event-details">
        <div class="container">
            <h1><?php echo htmlspecialchars($event['event_name']); ?></h1>
            <div class="event-meta">
                <p><strong>Date:</strong> <?php echo date('F d, Y', strtotime($event['event_date'])); ?></p>
                <p><strong>Time:</strong> <?php echo date('h:i A', strtotime($event['event_time'])); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($event['event_location']); ?></p>
                <p><strong>Organizer:</strong> <?php echo htmlspecialchars($event['organizer_name']); ?> (<?php echo htmlspecialchars($event['organizer_email']); ?>)</p>
            </div>
            <p><?php echo nl2br(htmlspecialchars($event['event_description'])); ?></p>
            <?php if (!empty($event['event_image'])): ?>
                <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
            <?php endif; ?>
        </div>
    </section>
</body>
</html>