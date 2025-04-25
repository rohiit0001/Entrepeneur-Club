<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Startup Pitch Day Recap</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Header Section */
        .recap-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img88.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 80px 20px;
        }
        .recap-header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .recap-header p {
            font-size: 1.2rem;
        }

        /* Content Section */
        .recap-content {
            padding: 50px 20px;
            background-color: #f9f9f9;
        }
        .recap-content h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
            font-size: 2rem;
        }
        .recap-content p {
            line-height: 1.8;
            color: #555;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        /* Gallery Section */
        .recap-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .recap-gallery img {
            width: 100%;
            height: 200px; /* Ensures all images have the same height */
            object-fit: cover; /* Ensures the image maintains aspect ratio */
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .recap-gallery img:hover {
            transform: scale(1.05); /* Adds a zoom effect on hover */
        }

        /* Back Button */
        .back-btn {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #2a7de1;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        .back-btn:hover {
            background-color: #1c68c5;
        }

        /* Footer Section */
        footer {
            background: #2a7de1;
            color: white;
            padding: 30px 20px;
        }
        footer .footer-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }
        footer .footer-col {
            flex: 1;
            min-width: 200px;
        }
        footer .footer-col h3,
        footer .footer-col h4 {
            margin-bottom: 15px;
        }
        footer .footer-col ul {
            list-style: none;
            padding: 0;
        }
        footer .footer-col ul li {
            margin-bottom: 10px;
        }
        footer .footer-col ul li a {
            color: white;
            text-decoration: none;
        }
        footer .footer-col ul li a:hover {
            text-decoration: underline;
        }
        footer .social-icons a {
            color: white;
            margin-right: 10px;
            font-size: 1.2rem;
        }
        footer .social-icons a:hover {
            color: #d1e6ff;
        }
        footer .copyright {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>Entrepreneurs Club</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php" class="active">Events</a></li>
                    <li><a href="members.php">Members</a></li>
                    <li><a href="login.php" class="btn btn-login">Login</a></li>
                    <li><a href="register.php" class="btn btn-register">Join Now</a></li>
                </ul>
            </nav>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <section class="recap-header">
        <div class="container">
            <h1>Startup Pitch Day</h1>
            <p>March 15, 2024 | Tech Hub, Austin</p>
        </div>
    </section>

    <section class="recap-content">
        <div class="container">
            <h2>Event Recap</h2>
            <p>The Startup Pitch Day was an incredible event that brought together aspiring entrepreneurs, investors, and industry leaders. The event featured 15 startups pitching their innovative ideas to a panel of esteemed judges and a live audience.</p>
            <p>The winning pitch, "GreenTech Solutions," showcased a groundbreaking approach to sustainable energy, earning the team a $50,000 investment and mentorship opportunities. Other notable pitches included "HealthAI," a healthcare-focused AI platform, and "EduNext," an ed-tech solution for personalized learning.</p>
            <p>The event concluded with a networking session, where participants had the opportunity to connect with investors, mentors, and fellow entrepreneurs.</p>

            <h2>Event Highlights</h2>
            <div class="recap-gallery">
                <img src="pitch1.jpg" alt="Startup Pitch">
                <img src="pitch2.webp" alt="Judges Panel">
                <img src="pitch3.jpg" alt="Networking Session">
            </div>

            <a href="events.php" class="back-btn">Back to Events</a>
        </div>
    </section>

    <footer>
        <div class="container">
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
        </div>
    </footer>
</body>
</html>