<?php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user = get_user_by_id($_SESSION['user_id']);
$upcoming_events = get_upcoming_events(5);

include 'header.php';
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<section class="dashboard">
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($user['first_name']); ?>!</h1>
        
        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h2><i class="fas fa-user-circle"></i> Your Profile</h2>
                <p>Profile Completion: <?php echo get_profile_completeness($user['id']); ?>%</p>
                <a href="profile.php" class="btn btn-primary">View Profile</a>
                <a href="edit-profile.php" class="btn btn-secondary">Edit Profile</a>
            </div>
            
            <div class="dashboard-card">
                <h2><i class="fas fa-calendar-alt"></i> Upcoming Events</h2>
                <?php if (empty($upcoming_events)): ?>
                    <p>No upcoming events.</p>
                <?php else: ?>
                    <ul class="events-list">
                        <?php foreach ($upcoming_events as $event): ?>
                            <li>
                                <h3><?php echo htmlspecialchars($event['title']); ?></h3>
                                <p><?php echo format_date($event['event_date']); ?> at <?php echo $event['start_time']; ?></p>
                                <p><?php echo htmlspecialchars($event['location']); ?></p>
                                <?php if (is_user_attending_event($user['id'], $event['id'])): ?>
                                    <span class="registered">Registered</span>
                                <?php else: ?>
                                    <a href="register_event.php?id=<?php echo $event['id']; ?>" class="btn btn-primary">Register</a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <a href="events.php" class="view-all">View All Events</a>
            </div>
            
            <div class="dashboard-card">
                <h2><i class="fas fa-users"></i> Your Connections</h2>
                <?php
                $stmt = $conn->prepare("SELECT u.* FROM users u 
                    JOIN connections c ON (u.id = c.user_id2 OR u.id = c.user_id1) 
                    WHERE (c.user_id1 = ? OR c.user_id2 = ?) 
                    AND u.id != ? 
                    AND c.status = 'accepted' 
                    LIMIT 3");
                $stmt->bind_param("iii", $user['id'], $user['id'], $user['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
                ?>
                <?php if ($result->num_rows > 0): ?>
                    <ul class="connections-list">
                        <?php while ($connection = $result->fetch_assoc()): ?>
                            <li>
                                <a href="profile.php?id=<?php echo $connection['id']; ?>">
                                    <?php echo htmlspecialchars($connection['first_name'] . ' ' . $connection['last_name']); ?>
                                </a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <a href="my-connections.php" class="view-all">View All Connections</a>
                <?php else: ?>
                    <p>No connections yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>



<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #f0f4f8, #d9e8fc);
    margin: 0;
    padding: 0;
}

.dashboard {
    padding: 40px 20px;
}

.dashboard h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #2a7de1;
    font-size: 2.5rem;
    font-weight: bold;
}

/* Grid Layout */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Card Styles */
.dashboard-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #e0e0e0;
}

.dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.dashboard-card h2 {
    margin-bottom: 15px;
    color: #2a7de1;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 1.5rem;
}

.dashboard-card p {
    color: #555;
    font-size: 1rem;
    line-height: 1.5;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 14px;
    font-weight: bold;
    transition: background 0.3s, color 0.3s;
}

.btn-primary {
    background: #2a7de1;
    color: white;
}

.btn-primary:hover {
    background: #1a5bb8;
}

.btn-secondary {
    background: #f0f0f0;
    color: #333;
}

.btn-secondary:hover {
    background: #e0e0e0;
}

/* List Styles */
.events-list li, .connections-list li {
    margin-bottom: 15px;
    font-size: 1rem;
}

.registered {
    color: green;
    font-weight: bold;
}

.view-all {
    display: block;
    margin-top: 15px;
    color: #2a7de1;
    text-align: right;
    font-weight: bold;
    font-size: 0.9rem;
}

.view-all:hover {
    text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 768px) {
    .dashboard h1 {
        font-size: 2rem;
    }

    .dashboard-card h2 {
        font-size: 1.25rem;
    }

    .btn {
        font-size: 12px;
    }
}
</style>