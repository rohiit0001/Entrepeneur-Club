<?php
// filepath: c:\xampp\htdocs\int219\edit-education.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];
$education_id = isset($_GET['id']) ? (int)$_GET['id'] : null;

if (!$education_id) {
    header("Location: profile.php");
    exit();
}

// Fetch the existing education details
$stmt = $conn->prepare("SELECT * FROM user_education WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $education_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$education = $result->fetch_assoc();
$stmt->close();

if (!$education) {
    header("Location: profile.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $degree = trim($_POST['degree']);
    $school = trim($_POST['school']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?? null;
    $description = trim($_POST['description']);
    $school_logo = $education['school_logo'];

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

    // Update the education in the database
    $stmt = $conn->prepare("UPDATE user_education SET degree = ?, school = ?, start_date = ?, end_date = ?, description = ?, school_logo = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ssssssii", $degree, $school, $start_date, $end_date, $description, $school_logo, $education_id, $user_id);

    if ($stmt->execute()) {
        header("Location: profile.php");
        exit();
    } else {
        $error_message = "Failed to update education. Please try again.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Education</title>
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
        <h2>Edit Education</h2>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="edit-education.php?id=<?php echo $education_id; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree" value="<?php echo htmlspecialchars($education['degree']); ?>" required>
            </div>
            <div class="form-group">
                <label for="school">School</label>
                <input type="text" id="school" name="school" value="<?php echo htmlspecialchars($education['school']); ?>" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($education['start_date']); ?>" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date (Leave blank if currently studying)</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($education['end_date']); ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($education['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="school_logo">School Logo (Optional)</label>
                <input type="file" id="school_logo" name="school_logo" accept="image/*">
                <?php if (!empty($education['school_logo'])): ?>
                    <p>Current Logo: <img src="<?php echo htmlspecialchars($education['school_logo']); ?>" alt="School Logo" style="max-width: 100px;"></p>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn">Update Education</button>
        </form>
    </div>
</body>
</html>