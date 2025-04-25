<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Entrepreneurs Club</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2a7de1, #1c68c5);
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header .logo h1 {
            font-size: 2rem;
            color: #2a7de1;
            margin: 0;
            font-weight: bold;
        }

        header nav ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        header nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        header nav ul li a:hover {
            color: #2a7de1;
        }

        header .btn {
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        header .btn-login {
            background: #2a7de1;
            color: #fff;
        }

        header .btn-login:hover {
            background: #1c68c5;
        }

        header .btn-register {
            background: #fff;
            color: #2a7de1;
            border: 2px solid #2a7de1;
        }

        header .btn-register:hover {
            background: #2a7de1;
            color: #fff;
        }

        /* Login Form Styles */
        .auth-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .auth-form h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #2a7de1;
            font-size: 2rem;
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #2a7de1;
            box-shadow: 0 0 5px rgba(42, 125, 225, 0.5);
        }

        .form-group a {
            color: #2a7de1;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .form-group a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            display: block;
            width: 100%;
            padding: 12px;
            background: #2a7de1;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #1c68c5;
            transform: scale(1.02);
        }

        .form-footer {
            margin-top: 30px;
            text-align: center;
        }

        .form-footer p {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .form-footer a {
            color: #2a7de1;
            text-decoration: none;
            font-weight: bold;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Footer Styles */
        footer {
            background: #2a7de1;
            color: #fff;
            padding: 40px 0;
            margin-top: 50px;
        }

        footer .footer-grid {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        footer .footer-col h3, footer .footer-col h4 {
            margin-bottom: 15px;
            color: #fff;
        }

        footer .footer-col ul {
            list-style: none;
            padding: 0;
        }

        footer .footer-col ul li a {
            text-decoration: none;
            color: #d1e6ff;
            font-size: 0.9rem;
        }

        footer .footer-col ul li a:hover {
            color: #fff;
        }

        footer .social-icons a {
            color: #d1e6ff;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        footer .social-icons a:hover {
            color: #fff;
        }

        footer .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<script>alert('Registration successful! Please log in.');</script>";
    }
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'incorrect_password') {
            echo "<script>alert('Incorrect password. Please try again.');</script>";
        } elseif ($_GET['error'] == 'email_not_found') {
            echo "<script>alert('Email not found. Please register or try again.');</script>";
        }
    }
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        echo "<script>alert('You have successfully logged out.');</script>";
    }
    ?>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Entrepreneurs Club</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="login.php" class="btn btn-login active">Login</a></li>
                    <li><a href="register.php" class="btn btn-register">Join Now</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="auth-container">
        <form class="auth-form" action="login_process.php" method="post">
            <h2>Login to Your Account</h2>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
                <label style="display: inline-flex; align-items: center; margin: 0;">
                    <input type="checkbox" name="remember" style="width: auto; margin-right: 8px;">
                    Remember me
                </label>
                <a href="forgot-password.php" style="font-size: 0.9rem;">Forgot Password?</a>
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
            
            <div class="form-footer">
                <p>Don't have an account? <a href="register.php">Register Now</a></p>
            </div>
        </form>
    </div>

    <footer>
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Entrepreneurs Club</h3>
                <p>Building a community of innovative entrepreneurs focused on networking and celebration.</p>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="members.php">Members</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Us</h4>
                <p>Email: 2004rohitvishu@gmail.com</p>
                <p>Phone: +919521757508</p>
                <div class="social-icons">
                    
                    <a href="https://x.com/2004rohitvishu"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/feed/"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.instagram.com/rohit_agrawal6265/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 Entrepreneurs Club. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>