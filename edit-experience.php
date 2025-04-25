<?php
// filepath: c:\xampp\htdocs\int219\edit-experience.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$experience_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$experience_id) {
    header("Location: profile.php");
    exit();
}

// Fetch the existing experience details
$stmt = $conn->prepare("SELECT * FROM user_experience WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $experience_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$experience = $result->fetch_assoc();
$stmt->close();

if (!$experience) {
    header("Location: profile.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $company = trim($_POST['company']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?? null;
    $description = trim($_POST['description']);
    $company_logo = $experience['company_logo'];

    // Handle company logo upload
    if (!empty($_FILES['company_logo']['name'])) {
        $target_dir = "uploads/company_logos/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES['company_logo']['name']);
        if (move_uploaded_file($_FILES['company_logo']['tmp_name'], $target_file)) {
            $company_logo = $target_file;
        }
    }

    // Update the experience in the database
    $stmt = $conn->prepare("UPDATE user_experience SET title = ?, company = ?, start_date = ?, end_date = ?, description = ?, company_logo = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssssii", $title, $company, $start_date, $end_date, $description, $company_logo, $experience_id, $user_id);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Failed to update experience. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Experience</title>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: none;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #2575fc;
            color: #fff;
            border: none;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
        }
        .btn:hover {
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
        <h2>Edit Experience</h2>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="edit-experience.php?id=<?php echo $experience_id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Job Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($experience['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" id="company" name="company" value="<?php echo htmlspecialchars($experience['company']); ?>" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($experience['start_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date (Leave blank if currently working)</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($experience['end_date']); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($experience['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="company_logo">Company Logo (Optional)</label>
                <input type="file" id="company_logo" name="company_logo" accept="image/*">
                <?php if (!empty($experience['company_logo'])): ?>
                    <p>Current Logo: <img src="<?php echo htmlspecialchars($experience['company_logo']); ?>" alt="Company Logo" style="max-width: 100px;"></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn">Update Experience</button>
        </form>
    </div>
</body>
</html>