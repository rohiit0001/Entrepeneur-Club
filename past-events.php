<?php
// Database connection
require_once 'db_connect.php';

// Fetch all past events from the database
$current_date = date('Y-m-d');
$stmt = $conn->prepare("SELECT * FROM events WHERE event_date < ? ORDER BY event_date DESC");
$stmt->bind_param("s", $current_date);
$stmt->execute();
$past_events = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Past Events - Entrepreneurs Club</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .past-events {
            padding: 50px 20px;
            background-color: #f9f9f9;
        }
        .past-events h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .event-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .event-card:hover {
            transform: translateY(-5px);
        }
        .event-image img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .event-content {
            padding: 20px;
        }
        .event-date {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 10px;
        }
        .event-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        .event-description {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 15px;
        }
        .btn-small {
            display: inline-block;
            padding: 8px 15px;
            background-color: #2a7de1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: background-color 0.3s ease;
        }
        .btn-small:hover {
            background-color: #1c68c5;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Entrepreneurs Club</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="login.php" class="btn btn-login">Login</a></li>
                    <li><a href="register.php" class="btn btn-register">Join Now</a></li>
                </ul>
            </nav>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="past-events">
        <div class="container">
            <h1>Past Events</h1>
            <div class="events-grid">
                <?php if ($past_events->num_rows > 0): ?>
                    <?php while ($event = $past_events->fetch_assoc()): ?>
                        <div class="event-card">
                            <div class="event-image">
                                <?php if (!empty($event['event_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                                <?php else: ?>
                                    <img src="default-event.jpg" alt="Default Event Image">
                                <?php endif; ?>
                            </div>
                            <div class="event-content">
                                <p class="event-date"><?php echo date('F d, Y', strtotime($event['event_date'])); ?></p>
                                <h3 class="event-title"><?php echo htmlspecialchars($event['event_name']); ?></h3>
                                <p class="event-description"><?php echo htmlspecialchars($event['event_description']); ?></p>
                                <a href="event-details.php?id=<?php echo $event['id']; ?>" class="btn-small">View Details</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No past events found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h3>Entrepreneurs Club</h3>
                    <p>Building a community of innovative entrepreneurs focused on networking and celebration.</p>
                </div>
                <div class="footer-col">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="members.php">Members</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Contact Us</h4>
                    <p>Email: 2004rohitvishu@gmail.com</p>
                    <p>Phone: +919521757508</p>
                    <div class="social-icons">
                        <a href="https://x.com/2004rohitvishu"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.instagram.com/rohit_agrawal6265/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Entrepreneurs Club. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>