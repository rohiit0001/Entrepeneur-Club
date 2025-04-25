<?php
 //filepath: c:\xampp\htdocs\int219\register.php
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>alert('Registration successful!');</script>";
}
if (isset($_GET['error']) && $_GET['error'] == 'email_exists') {
    echo "<script>alert('This email is already registered. Please use a different email.');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Entrepreneurs Club</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(circle, #6a11cb, #2575fc);
            color: #333;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, #2575fc, #6a11cb); /* Added gradient background */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
        }

        header .logo h1 {
            color: #fff; /* Adjusted text color for better contrast */
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin: 0;
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 10px 0 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff; /* Adjusted link color for better contrast */
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        nav ul li a:hover {
            color: #ffdd57; /* Added hover effect for links */
        }

        /* Form Container */
        .auth-container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-form h2 {
            font-size: 2rem;
            color: #2575fc;
            margin-bottom: 20px;
            text-align: center;
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

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
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
            transform: scale(1.02);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Footer Styles */
        footer {
            background: linear-gradient(135deg, #333, #444);
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer .social-icons a {
            color: #fff;
            margin: 0 10px;
            font-size: 1.5rem;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        footer .social-icons a:hover {
            color: #ff3860;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <h1>Entrepreneurs Club</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="members.php">Members</a></li>
            </ul>
        </nav>
    </header>

    <div class="auth-container">
        <form class="auth-form" action="register_process.php" method="post">
            <h2>Create Your Account</h2>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="industry">Industry</label>
                <select id="industry" name="industry" required>
                    <option value="">Select your industry</option>
                    <option value="technology">Technology</option>
                    <option value="finance">Finance</option>
                    <option value="healthcare">Healthcare</option>
                    <option value="education">Education</option>
                    <option value="retail">Retail</option>
                    <option value="manufacturing">Manufacturing</option>
                    <option value="marketing">Marketing</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="bio">Brief Bio (Optional)</label>
                <textarea id="bio" name="bio" rows="4"></textarea>
            </div>
            <div class="form-group" style="display: flex; align-items: flex-start;">
                <input type="checkbox" id="terms" name="terms" required style="width: auto; margin-right: 10px;">
                <label for="terms">I agree to the <a href="term.php">Terms of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
            </div>
            <button type="submit">Create Account</button>
            <div class="form-footer">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; 2025 Entrepreneurs Club. All rights reserved.</p>
        <div class="social-icons">
            
            <a href="https://x.com/2004rohitvishu"><i class="fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin"></i></a>
            <a href="https://www.instagram.com/rohit_agrawal6265/"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>