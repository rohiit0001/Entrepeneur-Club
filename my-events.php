<?php
// filepath: c:\xampp\htdocs\int219\my-events.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Fetch events for the logged-in user
$stmt = $conn->prepare("SELECT e.* FROM events e 
    JOIN event_attendees ea ON e.id = ea.event_id 
    WHERE ea.user_id = ? 
    ORDER BY e.event_date DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

include 'header.php';

if (isset($_GET['success']) && $_GET['success'] == 'registered') {
    echo "<script>alert('You have successfully registered for the event!');</script>";
}

if (isset($_GET['error']) && $_GET['error'] == 'already_registered') {
    echo "<script>alert('You are already registered for this event.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events - Entrepreneurs Club</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #2575fc;
            margin-bottom: 30px;
        }

        .events-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .event-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            width: calc(33.333% - 20px);
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .event-date {
            background: #2575fc;
            color: #fff;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 15px;
        }

        .event-date .day {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .event-date .month {
            font-size: 0.9rem;
            text-transform: uppercase;
        }

        .event-details h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .event-details p {
            font-size: 0.9rem;
            color: #666;
        }

        .empty-section {
            text-align: center;
            color: #999;
            font-style: italic;
            margin-top: 50px;
        }

        @media (max-width: 768px) {
            .event-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .event-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Events</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="events-list">
                <?php while ($event = $result->fetch_assoc()): ?>
                    <div class="event-card">
                        <div class="event-date">
                            <span class="day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                            <span class="month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                        </div>
                        <div class="event-details">
                            <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                            <p><i class="fas fa-clock"></i> <?php echo date('h:i A', strtotime($event['start_time'])); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="empty-section">You have not attended any events yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>