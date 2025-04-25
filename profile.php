<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

$viewing_own_profile = false;
$user_id = null;

if (isset($_GET['id'])) {
    $user_id = (int)$_GET['id'];
} elseif (is_logged_in()) {
    $user_id = $_SESSION['user_id'];
    $viewing_own_profile = true;
} else {
    redirect('login.php');
}

$user = get_user_by_id($user_id);

if (!$user) {
    redirect('members.php');
}

include 'header.php';
?>

<section class="profile-header">
    <div class="container">
        <div class="profile-info">
            <div class="profile-avatar">
                <?php if (!empty($user['profile_image']) && file_exists($user['profile_image'])): ?>
                    <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="<?php echo htmlspecialchars($user['first_name']); ?>">
                <?php else: ?>
                    <div class="avatar-placeholder">
                        <?php echo strtoupper(substr($user['first_name'], 0, 1) . substr($user['last_name'], 0, 1)); ?>
                    </div>
                <?php endif; ?>
                <?php if ($viewing_own_profile): ?>
                    <a href="edit-profile.php#avatar" class="edit-avatar-btn"><i class="fas fa-camera"></i></a>
                <?php endif; ?>
            </div>
            <div class="profile-details">
                <h1><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></h1>
                <p class="profile-title">Entrepreneur at <?php echo !empty($user['company']) ? htmlspecialchars($user['company']) : 'Not specified'; ?></p>
                <div class="profile-meta">
                    <span><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($user['industry'] ?? 'Not specified'); ?></span>
                    <?php if (!empty($user['website'])): ?>
                        <span><i class="fas fa-globe"></i> <a href="<?php echo htmlspecialchars($user['website']); ?>" target="_blank"><?php echo htmlspecialchars($user['website']); ?></a></span>
                    <?php endif; ?>
                </div>
                <div class="profile-stats">
                    <?php
                    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM connections 
                        WHERE (user_id1 = ? OR user_id2 = ?) 
                        AND status = 'accepted'");
                    $stmt->bind_param("ii", $user_id, $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $connections_count = $result->fetch_assoc()['count'];
                    $stmt->close();

                    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM event_attendees WHERE user_id = ?");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $events_count = $result->fetch_assoc()['count'];
                    $stmt->close();
                    ?>
                    <div class="stat-item">
                        <span class="stat-value"><?php echo $connections_count; ?></span>
                        <span class="stat-label">Connections</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value"><?php echo $events_count; ?></span>
                        <span class="stat-label">Events</span>
                    </div>
                    <?php if ($viewing_own_profile): ?>
                        <div class="stat-item">
                            <span class="stat-value"><?php echo get_profile_completeness($user_id); ?>%</span>
                            <span class="stat-label">Profile</span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="profile-actions">
                    <?php if ($viewing_own_profile): ?>
                        <a href="edit-profile.php" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Profile</a>
                    <?php else: ?>
                        <?php
                        $is_connected = false;
                        $connection_status = null;
                        $current_user_id = $_SESSION['user_id'] ?? 0;

                        if ($current_user_id > 0) {
                            $stmt = $conn->prepare("SELECT status FROM connections 
                                WHERE (user_id1 = ? AND user_id2 = ?) 
                                OR (user_id1 = ? AND user_id2 = ?)");
                            $stmt->bind_param("iiii", $current_user_id, $user_id, $user_id, $current_user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if ($result && $result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $connection_status = $row['status'];
                                $is_connected = ($connection_status == 'accepted');
                            }
                            $stmt->close();
                        }
                        ?>
                        <?php if ($is_connected): ?>
                            <button class="btn btn-secondary" disabled><i class="fas fa-check"></i> Connected</button>
                        <?php elseif ($connection_status == 'pending'): ?>
                            <button class="btn btn-secondary" disabled><i class="fas fa-clock"></i> Request Pending</button>
                        <?php else: ?>
                            <a href="send_connection.php?id=<?php echo $user_id; ?>" class="btn btn-primary"><i class="fas fa-user-plus"></i> Connect</a>
                        <?php endif; ?>
                        <a href="send_message.php?id=<?php echo $user_id; ?>" class="btn btn-secondary"><i class="fas fa-envelope"></i> Message</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="profile-content">
    <div class="container">
        <div class="profile-grid">
            <div class="profile-main">
                <div class="profile-section">
                    <h2>About</h2>
                    <?php if (!empty($user['bio'])): ?>
                        <p><?php echo nl2br(htmlspecialchars($user['bio'])); ?></p>
                    <?php else: ?>
                        <p class="empty-section">No bio information available.</p>
                    <?php endif; ?>
                    <?php if ($viewing_own_profile && empty($user['bio'])): ?>
                        <a href="edit-profile.php#bio" class="add-info-btn"><i class="fas fa-plus"></i> Add Bio</a>
                    <?php endif; ?>
                </div>

                <div class="profile-section">
                    <h2>Experience</h2>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM user_experience WHERE user_id = ? ORDER BY start_date DESC");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    
                    if ($result && $result->num_rows > 0):
                    ?>
                        <div class="experience-list">
                            <?php while ($experience = $result->fetch_assoc()): ?>
                                <div class="experience-item">
                                    <div class="experience-logo">
                                        <?php if (!empty($experience['company_logo'])): ?>
                                            <img src="<?php echo htmlspecialchars($experience['company_logo']); ?>" alt="<?php echo htmlspecialchars($experience['company']); ?>">
                                        <?php else: ?>
                                            <div class="logo-placeholder">
                                                <?php echo strtoupper(substr($experience['company'], 0, 1)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="experience-details">
                                        <h3><?php echo htmlspecialchars($experience['title']); ?></h3>
                                        <p class="experience-company"><?php echo htmlspecialchars($experience['company']); ?></p>
                                        <p class="experience-date">
                                            <?php 
                                            echo date('M Y', strtotime($experience['start_date'])); 
                                            echo ' - ';
                                            echo !empty($experience['end_date']) ? date('M Y', strtotime($experience['end_date'])) : 'Present';
                                            ?>
                                        </p>
                                        <?php if (!empty($experience['description'])): ?>
                                            <p class="experience-description"><?php echo nl2br(htmlspecialchars($experience['description'])); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($viewing_own_profile): ?>
                                        <div class="experience-actions">
                                            <a href="edit-experience.php?id=<?php echo $experience['id']; ?>" class="edit-btn"><i class="fas fa-edit"></i></a>
                                            <a href="delete-experience.php?id=<?php echo $experience['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this experience?');"><i class="fas fa-trash"></i></a>
                                            <?php if ($viewing_own_profile): ?>
                                                <a href="delete-experience.php?id=<?php echo $experience['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this experience?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="empty-section">No experience information available.</p>
                    <?php endif; ?>
                    <?php if ($viewing_own_profile): ?>
                        <a href="add-experience.php" class="add-info-btn"><i class="fas fa-plus"></i> Add Experience</a>
                    <?php endif; ?>
                </div>

                <div class="profile-section">
                    <h2>Education</h2>
                    <?php
                    $stmt = $conn->prepare("SELECT * FROM user_education WHERE user_id = ? ORDER BY start_date DESC");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    ?>
                    <?php
                    if ($result && $result->num_rows > 0):
                    ?>
                        <div class="education-list">
                            <?php while ($education = $result->fetch_assoc()): ?>
                                <div class="education-item">
                                    <div class="education-logo">
                                        <?php if (!empty($education['school_logo'])): ?>
                                            <img src="<?php echo htmlspecialchars($education['school_logo']); ?>" alt="<?php echo htmlspecialchars($education['school']); ?>">
                                        <?php else: ?>
                                            <div class="logo-placeholder">
                                                <?php echo strtoupper(substr($education['school'], 0, 1)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="education-details">
                                        <h3><?php echo htmlspecialchars($education['degree']); ?></h3>
                                        <p class="education-school"><?php echo htmlspecialchars($education['school']); ?></p>
                                        <p class="education-date">
                                            <?php 
                                            echo date('Y', strtotime($education['start_date'])); 
                                            echo ' - ';
                                            echo !empty($education['end_date']) ? date('Y', strtotime($education['end_date'])) : 'Present';
                                            ?>
                                        </p>
                                        <?php if (!empty($education['description'])): ?>
                                            <p class="education-description"><?php echo nl2br(htmlspecialchars($education['description'])); ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($viewing_own_profile): ?>
                                        <div class="education-actions">
                                            <a href="edit-education.php?id=<?php echo $education['id']; ?>" class="edit-btn"><i class="fas fa-edit"></i></a>
                                            <a href="delete-education.php?id=<?php echo $education['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this education?');"><i class="fas fa-trash"></i></a>
                                            <?php if ($viewing_own_profile): ?>
                                                <a href="delete-education.php?id=<?php echo $education['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this education record?');">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="empty-section">No education information available.</p>
                    <?php endif; ?>
                    <?php if ($viewing_own_profile): ?>
                        <a href="add-education.php" class="add-info-btn"><i class="fas fa-plus"></i> Add Education</a>
                    <?php endif; ?>
                </div>

                <div class="profile-section">
                    <h2>Skills</h2>
                    <?php
                    $stmt = $conn->prepare("SELECT s.* FROM skills s 
                        JOIN user_skills us ON s.id = us.skill_id 
                        WHERE us.user_id = ? 
                        ORDER BY s.name");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    
                    if ($result && $result->num_rows > 0):
                    ?>
                        <div class="skills-list">
                            <?php while ($skill = $result->fetch_assoc()): ?>
                                <div class="skill-tag">
                                    <?php echo htmlspecialchars($skill['name']); ?>
                                    <?php if ($viewing_own_profile): ?>
                                        <a href="remove-skill.php?id=<?php echo $skill['id']; ?>" class="remove-skill" onclick="return confirm('Are you sure you want to remove this skill?');"><i class="fas fa-times"></i></a>
                                        <?php if ($viewing_own_profile): ?>
                                            <a href="remove-skill.php?id=<?php echo $skill['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to remove this skill?');">
                                                <i class="fas fa-trash"></i> Remove
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p class="empty-section">No skills listed.</p>
                    <?php endif; ?>
                    <?php if ($viewing_own_profile): ?>
                        <a href="add-skills.php" class="add-info-btn"><i class="fas fa-plus"></i> Add Skills</a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="profile-sidebar">
                <?php if ($viewing_own_profile && get_profile_completeness($user_id) < 100): ?>
                    <div class="profile-completion-card">
                        <h3>Complete Your Profile</h3>
                        <div class="progress-bar">
                            <div class="progress" style="width: <?php echo get_profile_completeness($user_id); ?>%"></div>
                        </div>
                        <p><?php echo get_profile_completeness($user_id); ?>% Complete</p>
                        <ul class="completion-tasks">
                            <?php if (empty($user['profile_image'])): ?>
                                <li><i class="fas fa-times-circle"></i> Add a profile photo</li>
                            <?php else: ?>
                                <li class="completed"><i class="fas fa-check-circle"></i> Add a profile photo</li>
                            <?php endif; ?>
                            <?php if (empty($user['bio'])): ?>
                                <li><i class="fas fa-times-circle"></i> Write a bio</li>
                            <?php else: ?>
                                <li class="completed"><i class="fas fa-check-circle"></i> Write a bio</li>
                            <?php endif; ?>
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_experience WHERE user_id = ?");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $has_experience = $result->fetch_assoc()['count'] > 0;
                            $stmt->close();
                            ?>
                            <?php if (!$has_experience): ?>
                                <li><i class="fas fa-times-circle"></i> Add work experience</li>
                            <?php else: ?>
                                <li class="completed"><i class="fas fa-check-circle"></i> Add work experience</li>
                            <?php endif; ?>
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_education WHERE user_id = ?");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $has_education = $result->fetch_assoc()['count'] > 0;
                            $stmt->close();
                            ?>
                            <?php if (!$has_education): ?>
                                <li><i class="fas fa-times-circle"></i> Add education</li>
                            <?php else: ?>
                                <li class="completed"><i class="fas fa-check-circle"></i> Add education</li>
                            <?php endif; ?>
                            <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM user_skills WHERE user_id = ?");
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $has_skills = $result->fetch_assoc()['count'] > 0;
                            $stmt->close();
                            ?>
                            <?php if (!$has_skills): ?>
                                <li><i class="fas fa-times-circle"></i> Add skills</li>
                            <?php else: ?>
                                <li class="completed"><i class="fas fa-check-circle"></i> Add skills</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="sidebar-card">
                    <h3>Connections</h3>
                    <?php
                    $stmt = $conn->prepare("SELECT u.* FROM users u 
                        JOIN connections c ON (u.id = c.user_id2 OR u.id = c.user_id1) 
                        WHERE (c.user_id1 = ? OR c.user_id2 = ?) 
                        AND u.id != ? 
                        AND c.status = 'accepted'
                        ORDER BY u.first_name, u.last_name
                        LIMIT 6");
                    $stmt->bind_param("iii", $user_id, $user_id, $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    
                    if ($result && $result->num_rows > 0):
                    ?>
                        <div class="connections-grid">
                            <?php while ($connection = $result->fetch_assoc()): ?>
                                <a href="profile.php?id=<?php echo $connection['id']; ?>" class="connection-item">
                                    <div class="connection-avatar">
                                        <?php if (!empty($connection['profile_image'])): ?>
                                            <img src="<?php echo htmlspecialchars($connection['profile_image']); ?>" alt="<?php echo htmlspecialchars($connection['first_name']); ?>">
                                        <?php else: ?>
                                            <div class="avatar-placeholder">
                                                <?php echo strtoupper(substr($connection['first_name'], 0, 1) . substr($connection['last_name'], 0, 1)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <span class="connection-name"><?php echo htmlspecialchars($connection['first_name'] . ' ' . $connection['last_name']); ?></span>
                                </a>
                            <?php endwhile; ?>
                        </div>
                        <?php if ($connections_count > 6): ?>
                            <a href="my-connections.php<?php echo $viewing_own_profile ? '' : '?id=' . $user_id; ?>" class="view-all-link">View all connections (<?php echo $connections_count; ?>)</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="empty-section">No connections yet.</p>
                    <?php endif; ?>
                </div>

                <div class="sidebar-card">
                    <h3>Recent Events</h3>
                    <?php
                    $stmt = $conn->prepare("SELECT e.* FROM events e 
                        JOIN event_attendees ea ON e.id = ea.event_id 
                        WHERE ea.user_id = ? 
                        ORDER BY e.event_date DESC
                        LIMIT 3");
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $stmt->close();
                    
                    if ($result && $result->num_rows > 0):
                    ?>
                        <div class="events-list">
                            <?php while ($event = $result->fetch_assoc()): ?>
                                <div class="event-item">
                                    <div class="event-date">
                                        <span class="day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                                        <span class="month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                                    </div>
                                    <div class="event-details">
                                        <h4><?php echo htmlspecialchars($event['title']); ?></h4>
                                        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></p>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        <?php if ($events_count > 3): ?>
                            <a href="my-events.php<?php echo $viewing_own_profile ? '' : '?id=' . $user_id; ?>" class="view-all-link">View all events (<?php echo $events_count; ?>)</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="empty-section">No events attended yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<style>
/* Profile Page Styles */
.profile-header {
    background-color: white;
    margin-bottom: 30px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.profile-info {
    display: flex;
    padding: 30px;
}

.profile-avatar {
    margin-right: 30px;
}

.profile-avatar img, .avatar-placeholder {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 5px solid white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    object-fit: cover;
}

.avatar-placeholder {
    background-color: #2a7de1;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 3rem;
    font-weight: bold;
}

.edit-avatar-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: #2a7de1;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.edit-avatar-btn:hover {
    background-color: #1c68c5;
}

.profile-details {
    flex-grow: 1;
    padding-top: 20px;
}

.profile-details h1 {
    font-size: 2.2rem;
    margin-bottom: 5px;
}

.profile-title {
    font-size: 1.2rem;
    color: #2a7de1;
    margin-bottom: 15px;
}

.profile-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.profile-meta span {
    color: #666;
    font-size: 0.95rem;
}

.profile-meta i {
    margin-right: 5px;
    color: #2a7de1;
}

.profile-stats {
    display: flex;
    gap: 30px;
    margin-bottom: 20px;
}

.stat-item {
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
}

.stat-label {
    font-size: 0.9rem;
    color: #666;
}

.profile-actions {
    display: flex;
    gap: 15px;
}

.profile-content {
    padding-bottom: 80px;
}

.profile-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 30px;
}

.profile-section {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 25px;
    margin-bottom: 30px;
}

.profile-section h2 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.profile-section p {
    line-height: 1.6;
}

.empty-section {
    color: #999;
    font-style: italic;
}

.add-info-btn {
    display: inline-block;
    margin-top: 15px;
    color: #2a7de1;
    font-size: 0.95rem;
}

.add-info-btn i {
    margin-right: 5px;
}

.experience-list, .education-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.experience-item, .education-item {
    display: flex;
    position: relative;
}

.experience-logo, .education-logo {
    margin-right: 20px;
    flex-shrink: 0;
}

.experience-logo img, .education-logo img, .logo-placeholder {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
}

.logo-placeholder {
    background-color: #2a7de1;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.5rem;
    font-weight: bold;
}

.experience-details, .education-details {
    flex-grow: 1;
}

.experience-details h3, .education-details h3 {
    font-size: 1.2rem;
    margin-bottom: 5px;
}

.experience-company, .education-school {
    color: #2a7de1;
    font-weight: 600;
    margin-bottom: 5px;
}

.experience-date, .education-date {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 10px;
}

.experience-description, .education-description {
    font-size: 0.95rem;
}

.experience-actions, .education-actions {
    position: absolute;
    top: 0;
    right: 0;
    display: flex;
    gap: 10px;
}

.edit-btn, .delete-btn {
    color: #666;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.edit-btn:hover {
    color: #2a7de1;
}

.delete-btn:hover {
    color: #e74c3c;
}

.skills-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.skill-tag {
    background-color: #f0f7ff;
    color: #2a7de1;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
}

.remove-skill {
    margin-left: 5px;
    color: #2a7de1;
    font-size: 0.8rem;
}

.sidebar-card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 25px;
    margin-bottom: 30px;
}

.sidebar-card h3 {
    font-size: 1.3rem;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.profile-completion-card {
    background-color: #f0f7ff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 25px;
    margin-bottom: 30px;
}

.profile-completion-card h3 {
    font-size: 1.3rem;
    margin-bottom: 15px;
    color: #2a7de1;
}

.progress-bar {
    height: 8px;
    background-color: #d1e6ff;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 10px;
}

.progress {
    height: 100%;
    background-color: #2a7de1;
}

.completion-tasks {
    margin-top: 15px;
}

.completion-tasks li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    font-size: 0.95rem;
}

.completion-tasks li i {
    margin-right: 10px;
    font-size: 1.1rem;
}

.completion-tasks li.completed {
    color: #27ae60;
}

.completion-tasks li:not(.completed) {
    color: #e74c3c;
}

.connections-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}

.connection-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

.connection-avatar {
    width: 60px;
    height: 60px;
    margin-bottom: 8px;
}

.connection-avatar img, .connection-avatar .avatar-placeholder {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
}

.connection-avatar .avatar-placeholder {
    font-size: 1.5rem;
}

.connection-name {
    font-size: 0.9rem;
    color: #333;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

.view-all-link {
    display: block;
    text-align: center;
    margin-top: 15px;
    color: #2a7de1;
    font-size: 0.95rem;
}

.events-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.event-item {
    display: flex;
    align-items: center;
}

.event-date {
    background-color: #2a7de1;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin-right: 15px;
}

.event-date .day {
    font-size: 1.2rem;
    font-weight: 700;
    line-height: 1;
}

.event-date .month {
    font-size: 0.7rem;
    text-transform: uppercase;
}

.event-details {
    flex-grow: 1;
}

.event-details h4 {
    font-size: 1rem;
    margin-bottom: 5px;
}

.event-details p {
    color: #666;
    font-size: 0.9rem;
}

.event-details i {
    margin-right: 5px;
    color: #2a7de1;
}

@media screen and (max-width: 992px) {
    .profile-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .profile-avatar {
        margin-right: 0;
        margin-bottom: 20px;
    }
    
    .profile-meta, .profile-stats, .profile-actions {
        justify-content: center;
    }
}

@media screen and (max-width: 768px) {
    .profile-details h1 {
        font-size: 1.8rem;
    }
    
    .profile-meta {
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
    
    .connections-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media screen and (max-width: 480px) {
    .profile-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .profile-actions .btn {
        width: 100%;
    }
    
    .experience-item, .education-item {
        flex-direction: column;
    }
    
    .experience-logo, .education-logo {
        margin-right: 0;
        margin-bottom: 15px;
    }
    
    .experience-actions, .education-actions {
        position: static;
        margin-top: 15px;
    }
}
</style>