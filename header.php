<?php
require_once 'functions.php';
start_session_if_not_started();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrepreneurs Club</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Entrepreneurs Club</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>Home</a></li>
                    <li><a href="about.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'class="active"' : ''; ?>>About</a></li>
                    <li><a href="events.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'events.php') ? 'class="active"' : ''; ?>>Events</a></li>
                    <li><a href="members.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'members.php') ? 'class="active"' : ''; ?>>Members</a></li>
                    <?php if (is_logged_in()): ?>
                        <li><a href="dashboard.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'class="active"' : ''; ?>>Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle">
                                <?php echo isset($_SESSION['user_name']) ? explode(' ', $_SESSION['user_name'])[0] : 'Account'; ?>
                                <i class="fas fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                                <li><a href="edit-profile.php"><i class="fas fa-edit"></i> Edit Profile</a></li>
                                <li><a href="my-connections.php"><i class="fas fa-users"></i> My Connections</a></li>
                                <li><a href="my-events.php"><i class="fas fa-calendar"></i> My Events</a></li>
                                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                                <li><a href="logout.php" class="btn btn-secondary"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="login.php" class="btn btn-login">Login</a></li>
                        <li><a href="register.php" class="btn btn-register">Join Now</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>