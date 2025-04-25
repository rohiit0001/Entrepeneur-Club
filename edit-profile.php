<?php
// filepath: c:\xampp\htdocs\int219\edit-profile.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$user = get_user_by_id($user_id);

$stmt = $conn->prepare("SELECT * FROM user_experience WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $bio = $_POST['bio'];
    $industry = $_POST['industry'];

    // Handle profile image upload
    if (!empty($_FILES['profile_image']['name'])) {
        $target_dir = "uploads/profile_images/";
        // Ensure the directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES['profile_image']['name']);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            $profile_image_path = $target_file;
        } else {
            $profile_image_path = $user['profile_image']; // Keep the existing image if upload fails
        }
    } else {
        $profile_image_path = $user['profile_image']; // Keep the existing image if no new image is uploaded
    }

    // Update the database with the new profile image path
    $stmt = $conn->prepare("UPDATE users SET profile_image = ? WHERE id = ?");
    $stmt->bind_param("si", $profile_image_path, $user_id);
    $stmt->execute();
    $stmt->close();

    // Update user data in the database
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, bio = ?, industry = ?, profile_image = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $bio, $industry, $profile_image_path, $user_id);

    if ($stmt->execute()) {
        // Redirect to profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Failed to update profile. Please try again.";
    }

    $stmt->close();
}

include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Entrepreneurs Club</title>
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

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
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

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="edit-profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea id="bio" name="bio" rows="4"><?php echo htmlspecialchars($user['bio']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="industry">Industry</label>
                <select id="industry" name="industry" required>
                    <option value="education" <?php echo $user['industry'] == 'education' ? 'selected' : ''; ?>>Education</option>
                    <option value="retail" <?php echo $user['industry'] == 'retail' ? 'selected' : ''; ?>>Retail</option>
                    <option value="manufacturing" <?php echo $user['industry'] == 'manufacturing' ? 'selected' : ''; ?>>Manufacturing</option>
                    <option value="marketing" <?php echo $user['industry'] == 'marketing' ? 'selected' : ''; ?>>Marketing</option>
                    <option value="other" <?php echo $user['industry'] == 'other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="profile_image">Profile Image</label>
                <input type="file" id="profile_image" name="profile_image">
                <?php if (!empty($user['profile_image'])): ?>
                    <p>Current Image: <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" style="width: 100px; height: 100px; border-radius: 50%;"></p>
                <?php endif; ?>
            </div>
            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>