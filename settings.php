<?php
// filepath: c:\xampp\htdocs\int219\settings.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Fetch the current password from the database
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if (password_verify($current_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $stmt->bind_param("si", $hashed_password, $user_id);
                $stmt->execute();
                $stmt->close();
                $success_message = "Password updated successfully.";
            } else {
                $error_message = "New password and confirm password do not match.";
            }
        } else {
            $error_message = "Current password is incorrect.";
        }
    }

    if (isset($_POST['delete_account'])) {
        // Delete the user's account
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();

        // Log the user out and redirect to the homepage
        session_destroy();
        redirect('index.php');
    }
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Entrepreneurs Club</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-group input:focus {
            box-shadow: 0 0 8px rgba(37, 117, 252, 0.5);
            border-color: #2575fc;
        }

        button {
            background: #2575fc;
            color: #fff;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        button:hover {
            background: #1a5bb8;
        }

        .error-message, .success-message {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .error-message {
            color: red;
        }

        .success-message {
            color: green;
        }

        .delete-account {
            background: #e74c3c;
        }

        .delete-account:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Settings</h1>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <form action="settings.php" method="post">
            <h2>Change Password</h2>
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password">Update Password</button>
        </form>

        <form action="settings.php" method="post" style="margin-top: 30px;">
            <h2>Delete Account</h2>
            <p style="color: red; font-size: 0.9rem;">Warning: This action cannot be undone.</p>
            <button type="submit" name="delete_account" class="delete-account">Delete My Account</button>
        </form>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>