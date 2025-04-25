<?php
// filepath: c:\xampp\htdocs\int219\my-connections.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Fetch connections for the logged-in user
$stmt = $conn->prepare("
    SELECT u.id, u.first_name, u.last_name, u.profile_image 
    FROM users u
    JOIN connections c ON (u.id = c.user_id1 OR u.id = c.user_id2)
    WHERE (c.user_id1 = ? OR c.user_id2 = ?)
    AND u.id != ?
    AND c.status = 'accepted'
    ORDER BY u.first_name, u.last_name
");
$stmt->bind_param("iii", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Connections - Entrepreneurs Club</title>
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

        .connections-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .connection-item {
            text-align: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .connection-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .connection-avatar {
            width: 100px;
            height: 100px;
            margin: 0 auto 10px;
            border-radius: 50%;
            overflow: hidden;
            background: #f0f0f0;
        }

        .connection-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .connection-name {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .view-profile-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 12px;
            font-size: 0.9rem;
            color: #fff;
            background: #2575fc;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .view-profile-btn:hover {
            background: #1a5bb8;
        }

        .empty-section {
            text-align: center;
            color: #999;
            font-style: italic;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>My Connections</h1>
        <?php if ($result && $result->num_rows > 0): ?>
            <div class="connections-grid">
                <?php while ($connection = $result->fetch_assoc()): ?>
                    <div class="connection-item">
                        <div class="connection-avatar">
                            <?php if (!empty($connection['profile_image'])): ?>
                                <img src="<?php echo htmlspecialchars($connection['profile_image']); ?>" alt="<?php echo htmlspecialchars($connection['first_name']); ?>">
                            <?php else: ?>
                                <div class="avatar-placeholder">
                                    <?php echo strtoupper(substr($connection['first_name'], 0, 1) . substr($connection['last_name'], 0, 1)); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="connection-name">
                            <?php echo htmlspecialchars($connection['first_name'] . ' ' . $connection['last_name']); ?>
                        </div>
                        <a href="profile.php?id=<?php echo $connection['id']; ?>" class="view-profile-btn">View Profile</a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p class="empty-section">You have no connections yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>