<?php
// Start session if not already started
function start_session_if_not_started() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Clean input data
function clean_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($conn) {
        $data = $conn->real_escape_string($data);
    }
    return $data;
}

// Check if user is logged in
function is_logged_in() {
    start_session_if_not_started();
    return isset($_SESSION['user_id']);
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
    exit();
}

// Display error message
function display_error($message) {
    return "<div class='error-message' style='color: red; padding: 10px; margin-bottom: 15px; background-color: #ffeeee; border-radius: 4px;'>$message</div>";
}

// Display success message
function display_success($message) {
    return "<div class='success-message' style='color: green; padding: 10px; margin-bottom: 15px; background-color: #eeffee; border-radius: 4px;'>$message</div>";
}

// Get user data by ID
function get_user_by_id($user_id) {
    global $conn;
    $user_id = (int)$user_id;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return false;
}

// Get upcoming events
function get_upcoming_events($limit = 5) {
    global $conn;
    $today = date('Y-m-d');
    $stmt = $conn->prepare("SELECT * FROM events WHERE event_date >= ? ORDER BY event_date ASC LIMIT ?");
    $stmt->bind_param("si", $today, $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    $events = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }
    
    return $events;
}

// Format date
function format_date($date, $format = 'M d, Y') {
    return date($format, strtotime($date));
}

// Get event attendees count
function get_event_attendees_count($event_id) {
    global $conn;
    $event_id = (int)$event_id;
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM event_attendees WHERE event_id = ?");
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    return 0;
}

// Check if user is attending an event
function is_user_attending_event($user_id, $event_id) {
    global $conn;
    $user_id = (int)$user_id;
    $event_id = (int)$event_id;
    
    $stmt = $conn->prepare("SELECT * FROM event_attendees WHERE user_id = ? AND event_id = ?");
    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    return ($result && $result->num_rows > 0);
}

// Register user for event
function register_for_event($user_id, $event_id) {
    global $conn;
    $user_id = (int)$user_id;
    $event_id = (int)$event_id;
    
    if (is_user_attending_event($user_id, $event_id)) {
        return false;
    }
    
    $stmt = $conn->prepare("INSERT INTO event_attendees (user_id, event_id, registered_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ii", $user_id, $event_id);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Get user profile completeness percentage
function get_profile_completeness($user_id) {
    global $conn;
    $user_id = (int)$user_id;
    
    $user = get_user_by_id($user_id);
    if (!$user) {
        return 0;
    }
    
    $total_fields = 8;
    $filled_fields = 0;
    
    if (!empty($user['first_name'])) $filled_fields++;
    if (!empty($user['last_name'])) $filled_fields++;
    if (!empty($user['email'])) $filled_fields++;
    if (!empty($user['company'])) $filled_fields++;
    if (!empty($user['industry'])) $filled_fields++;
    if (!empty($user['bio'])) $filled_fields++;
    if (!empty($user['profile_image'])) $filled_fields++;
    if (!empty($user['website'])) $filled_fields++;
    
    return round(($filled_fields / $total_fields) * 100);
}
?>