<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrepreneurship Conference 2024 Recap</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Header Section */
        .recap-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img9.webp');
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
            <h1>Entrepreneurship Conference 2024</h1>
            <p>April 10, 2024 | Business Center, New York</p>
        </div>
    </section>

    <section class="recap-content">
        <div class="container">
            <h2>Event Recap</h2>
            <p>The Entrepreneurship Conference 2024 was a landmark event that brought together over 500 entrepreneurs, investors, and industry leaders. The conference featured keynote speeches, panel discussions, and breakout sessions focused on innovation, leadership, and scaling businesses in a competitive market.</p>
            <p>Keynote speaker John Smith, founder of TechVision, shared his insights on building a billion-dollar company while navigating the challenges of a rapidly changing economy. The panel discussion on "Future of Entrepreneurship" provided actionable advice and strategies for attendees.</p>
            <p>The networking sessions were a highlight of the event, allowing participants to connect with like-minded professionals and explore potential collaborations. The conference concluded with a Q&A session, where attendees had the opportunity to interact with the speakers and panelists.</p>

            <h2>Event Highlights</h2>
            <div class="recap-gallery">
                <img src="event1.jpg" alt="Keynote Speech">
                <img src="event2.jpg" alt="Panel Discussion">
                <img src="event3.jpg" alt="Networking Session">
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