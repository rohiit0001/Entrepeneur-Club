<?php
// filepath: c:\xampp\htdocs\int219\add-skills.php
require_once 'db_connect.php';
require_once 'functions.php';

start_session_if_not_started();

if (!is_logged_in()) {
    redirect('login.php');
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $skill_name = trim($_POST['skill_name']);

    if (!empty($skill_name)) {
        // Check if the skill already exists in the skills table
        $stmt = $conn->prepare("SELECT id FROM skills WHERE name = ?");
        $stmt->bind_param("s", $skill_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $skill = $result->fetch_assoc();
        $stmt->close();

        if ($skill) {
            $skill_id = $skill['id'];
        } else {
            // Insert the skill into the skills table
            $stmt = $conn->prepare("INSERT INTO skills (name) VALUES (?)");
            $stmt->bind_param("s", $skill_name);
            $stmt->execute();
            $skill_id = $stmt->insert_id;
            $stmt->close();
        }

        // Link the skill to the user
        $stmt = $conn->prepare("INSERT INTO user_skills (user_id, skill_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $skill_id);

        if ($stmt->execute()) {
            header("Location: profile.php");
            exit();
        } else {
            $error_message = "Failed to add skill. Please try again.";
        }

        $stmt->close();
    } else {
        $error_message = "Skill name cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skills</title>
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
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
        <h2>Add Skills</h2>
        <?php if (isset($error_message)): ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="add-skills.php" method="post">
            <div class="form-group">
                <label for="skill_name">Skill Name</label>
                <input type="text" id="skill_name" name="skill_name" required>
            </div>
            <button type="submit" class="btn">Add Skill</button>
        </form>
    </div>
</body>
</html>