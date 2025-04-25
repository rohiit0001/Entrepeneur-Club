<?php
// filepath: c:\xampp\htdocs\int219\add-education.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = trim($_POST['degree']);
    $school = trim($_POST['school']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?? null;
    $description = trim($_POST['description']);
    $school_logo = null;

    // Handle school logo upload
    if (!empty($_FILES['school_logo']['name'])) {
        $target_dir = "uploads/school_logos/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . basename($_FILES['school_logo']['name']);
        if (move_uploaded_file($_FILES['school_logo']['tmp_name'], $target_file)) {
            $school_logo = $target_file;
        }
    }

    // Insert education into the database
    $stmt = $conn->prepare("INSERT INTO user_education (user_id, degree, school, start_date, end_date, description, school_logo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $user_id, $degree, $school, $start_date, $end_date, $description, $school_logo);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Failed to add education. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Education</title>
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
        <h2>Add Education</h2>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="add-education.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree" required>
            </div>
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" id="school" name="school" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date (Leave blank if currently studying)</label>
                <input type="date" id="end_date" name="end_date">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="school_logo">School Logo (Optional)</label>
                <input type="file" id="school_logo" name="school_logo" accept="image/*">
            </div>
            <button type="submit" class="btn">Add Education</button>
        </form>
    </div>
</body>
</html>