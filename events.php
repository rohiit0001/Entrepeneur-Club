<?php
// Database connection
require_once 'db_connect.php';

// Fetch all hosted events from the database
$stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date ASC");
$stmt->execute();
$events = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Entrepreneurs Club</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color:rgb(57, 162, 200);
        }

        .delete-btn:focus {
            outline: none;
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

    <section class="page-header">
        <div class="container">
            <h1>Events</h1>
            <p>Connect, learn, and grow with our networking events and workshops</p>
        </div>
    </section>

    <section class="events-filter">
        <div class="container">
            <div class="filter-container">
                <div class="filter-group">
                    <label for="event-type">Event Type</label>
                    <select id="event-type">
                        <option value="all">All Events</option>
                        <option value="networking">Networking</option>
                        <option value="workshop">Workshops</option>
                        <option value="seminar">Seminars</option>
                        <option value="conference">Conferences</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="event-date">Date Range</label>
                    <select id="event-date">
                        <option value="all">All Dates</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="quarter">Next 3 Months</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="event-location">Location</label>
                    <select id="event-location">
                        <option value="all">All Locations</option>
                        <option value="virtual">Virtual</option>
                        <option value="in-person">In-Person</option>
                    </select>
                </div>
                <button class="btn btn-primary filter-btn">Apply Filters</button>
            </div>
        </div>
    </section>

    <section class="events-featured">
        <div class="container">
            <h2 class="section-title">Featured Event</h2>
            <div class="featured-event">
                <div class="featured-image">
                    <img src="img1111.jpg" alt="Annual Entrepreneurship Summit">
                    <div class="event-date-badge">
                        <span class="month">JUN</span>
                        <span class="day">15</span>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="event-meta">
                        <span><i class="fas fa-tag"></i> Conference</span>
                        <span><i class="fas fa-map-marker-alt"></i> Manipal , India</span>
                    </div>
                    <h3>Annual Entrepreneurship Summit 2025</h3>
                    <p>Join us for our flagship event bringing together entrepreneurs, investors, and industry leaders for a day of inspiration, learning, and networking. This year's theme focuses on "Building Resilient Businesses in a Changing Economy."</p>
                    <div class="event-details">
                        <div class="detail-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Date & Time</h4>
                                <p>June 15, 2025 | 9:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user-friends"></i>
                            <div>
                                <h4>Attendees</h4>
                                <p>245 / 300 Registered</p>
                            </div>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-ticket-alt"></i>
                            <div>
                                <h4>Registration</h4>
                                <p>$99 - Early Bird (Until May 15)</p>
                            </div>
                        </div>
                    </div>
                    <a href="annual-summit-2025.php" class="btn btn-primary" class="btn btn-primary">View Details</a>
                    <a href="https://www.manipal.edu/mit/news-events/MES2025.html#:~:text=The%208th%20Manipal%20Entrepreneurship%20Summit%20%28MES%202025%29%20is,at%202%3A00%20PM%20at%20the%20MIT%20Quadrangle%2C%20Manipal." class="btn btn-primary">Register for Event</a>
                </div>
            </div>
        </div>
    </section>

    <section class="events-upcoming">
        <div class="container">
            <h2 class="section-title">Upcoming Events</h2>
            <div class="events-grid">
                <div class="event-card">
                    <div class="event-image">
                        
                        <div class="event-type">Workshop</div>
                        
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">15</span>
                            <span class="month">May</span>
                        </div>
                        <h3>Startup Funding Workshop</h3>
                        <p>Learn how to secure funding for your startup from experienced investors and entrepreneurs.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 2:00 PM - 4:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Virtual Event</span>
                        </div>
                        <a href="https://allevents.in/new%20delhi/global-startups-club-l-startup-networking-new-delhi-2025/80001043626805?ref=eventlist-ls-available" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                       
                        <div class="event-type">Networking</div>
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">22</span>
                            <span class="month">May</span>
                        </div>
                        <h3>Networking Mixer</h3>
                        <p>Connect with fellow entrepreneurs in a relaxed setting and expand your professional network.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 6:00 PM - 8:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Skyline Lounge, Chicago</span>
                        </div>
                        <a href="event-details.html?id=3" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                       
                        <div class="event-type">Seminar</div>
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">05</span>
                            <span class="month">Jun</span>
                        </div>
                        <h3>Digital Marketing Seminar</h3>
                        <p>Master the latest digital marketing strategies to grow your business online.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 10:00 AM - 12:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Virtual Event</span>
                        </div>
                        <a href="event-details.html?id=4" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                      
                        <div class="event-type">Competition</div>
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">12</span>
                            <span class="month">Jun</span>
                        </div>
                        <h3>Business Plan Competition</h3>
                        <p>Pitch your business idea to a panel of judges and win funding for your startup.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 1:00 PM - 5:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Innovation Center, Boston</span>
                        </div>
                        <a href="event-details.html?id=5" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                       
                        <div class="event-type">Workshop</div>
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">20</span>
                            <span class="month">Jun</span>
                        </div>
                        <h3>Leadership Workshop</h3>
                        <p>Develop essential leadership skills to effectively manage your team and business.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 9:00 AM - 4:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Business Center, San Francisco</span>
                        </div>
                        <a href="event-details.html?id=6" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-image">
                        
                        <div class="event-type">Showcase</div>
                    </div>
                    <div class="event-content">
                        <div class="event-date">
                            <span class="day">28</span>
                            <span class="month">Jun</span>
                        </div>
                        <h3>Tech Startup Showcase</h3>
                        <p>Discover innovative tech startups and connect with founders showcasing their latest products and solutions.</p>
                        <div class="event-meta">
                            <span><i class="fas fa-clock"></i> 3:00 PM - 7:00 PM</span>
                            <span><i class="fas fa-map-marker-alt"></i> Tech Hub, Austin</span>
                        </div>
                        <a href="https://allevents.in/new%20delhi/new-delhi-entrepreneurs-meetup-by-we-founders-collab-2025/80003139139809?ref=eventlist-ls-selling-fast" class="btn btn-secondary">View Details</a>
                    </div>
                </div>
            </div>
            
            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#" class="next">Next <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </section>

    <section class="hosted-events">
        <div class="container">
            <h2 class="section-title">Hosted Events</h2>
            <?php if (isset($_GET['delete_success']) && $_GET['delete_success'] == 1): ?>
                <p class="success-message">Event deleted successfully!</p>
            <?php endif; ?>
            <div class="events-grid">
                <?php if ($events->num_rows > 0): ?>
                    <?php while ($event = $events->fetch_assoc()): ?>
                        <div class="event-card">
                            <div class="event-image">
                                <?php if (!empty($event['event_image'])): ?>
                                    <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="<?php echo htmlspecialchars($event['event_name']); ?>">
                                <?php else: ?>
                                    <img src="default-event.jpg" alt="Default Event Image">
                                <?php endif; ?>
                            </div>
                            <div class="event-content">
                                <div class="event-date">
                                    <span class="day"><?php echo date('d', strtotime($event['event_date'])); ?></span>
                                    <span class="month"><?php echo date('M', strtotime($event['event_date'])); ?></span>
                                </div>
                                <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                                <p><?php echo htmlspecialchars($event['event_description']); ?></p>
                                <div class="event-meta">
                                    <span><i class="fas fa-clock"></i> <?php echo date('h:i A', strtotime($event['event_time'])); ?></span>
                                    <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['event_location']); ?></span>
                                </div>
                                <a href="event-details.php?id=<?php echo $event['id']; ?>" class="btn btn-secondary">View Details</a>
                                <form action="delete_event.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                    <button type="submit" class="btn btn-danger delete-btn" onclick="return confirm('Are you sure you want to delete this event?');">Delete Event</button>
                                </form>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>No hosted events found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="events-past">
        <div class="container">
            <h2 class="section-title">Past Events</h2>
            <div class="past-events-slider">
                <div class="past-event">
                    <img src="img9.webp" alt="Past Event">
                    <div class="past-event-overlay">
                        <h3>Entrepreneurship Conference 2024</h3>
                        <p>April 10, 2024</p>
                        <a href="entrepreneurship-conference-recap.php" class="btn btn-small">View Recap</a>
                    </div>
                </div>
                <div class="past-event">
                    <img src="img88.jpg" alt="Past Event">
                    <div class="past-event-overlay">
                        <h3>Startup Pitch Day</h3>
                        <p>March 15, 2024</p>
                        <a href="startup-pitch-day-recap.php" class="btn btn-small">View Recap</a>
                    </div>
                </div>
                <div class="past-event">
                    <img src="img77.jpg" alt="Past Event">
                    <div class="past-event-overlay">
                        <h3>Women in Business Forum</h3>
                        <p>February 22, 2024</p>
                        <a href="women-in-business-recap.php" class="btn btn-small">View Recap</a>
                    </div>
                </div>
            </div>
            <div class="center">
                <a href="past-events.php" class="btn btn-secondary">View All Past Events</a>
            </div>
        </div>
    </section>

    <section class="host-event">
        <div class="container">
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                <p class="success-message">Event proposal submitted successfully!</p>
            <?php endif; ?>
            <div class="host-event-content">
                <h2>Want to Host an Event?</h2>
                <p>If you're interested in hosting an event for our community, we'd love to hear from you! Our platform provides access to a diverse network of entrepreneurs and business professionals.</p>
                <a href="host-event.html" class="btn btn-primary">Submit Event Proposal</a>
            </div>
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

    <script src="main.js"></script>

    <style>
        /* Events Page Styles */
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../assets/images/events-header.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 3rem;
            margin-bottom: 15px;
        }
        
        .page-header p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .events-filter {
            background-color: white;
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .filter-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .filter-btn {
            padding: 10px 20px;
        }
        
        .events-featured, .events-upcoming, .events-past {
            padding: 80px 0;
        }
        
        .events-upcoming {
            background-color: #f9f9f9;
        }
        
        .featured-event {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .featured-image {
            position: relative;
            height: 100%;
        }
        
        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .event-date-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #2a7de1;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            min-width: 60px;
        }
        
        .event-date-badge .month {
            display: block;
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .event-date-badge .day {
            display: block;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .featured-content {
            padding: 30px;
        }
        
        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .event-meta span {
            color: #777;
            font-size: 0.9rem;
        }
        
        .event-meta i {
            margin-right: 5px;
            color: #2a7de1;
        }
        
        .featured-content h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        
        .featured-content p {
            margin-bottom: 20px;
            line-height: 1.6;
        }
        
        .event-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 20px 0;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        
        .detail-item {
            display: flex;
            align-items: flex-start;
        }
        
        .detail-item i {
            font-size: 1.5rem;
            color: #2a7de1;
            margin-right: 15px;
            margin-top: 5px;
        }
        
        .detail-item h4 {
            margin-bottom: 5px;
            font-size: 1rem;
        }
        
        .detail-item p {
            margin: 0;
            font-size: 0.9rem;
        }
        
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .event-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-10px);
        }
        
        .event-image {
            position: relative;
            height: 200px;
            
        }
        
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            
        }
        
        .event-type {
             position: relative;
            top: 15px;
            left: 10px; 
            background-color: rgba(42, 125, 225, 0.9);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .event-content {
            padding: 20px;
            position: relative;
        }
        
        .event-date {
             position: relative;
           /* top: -30px;*/
            left: 20px; 
            background-color: #2a7de1;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .event-date .day {
            font-size: 1.3rem;
            font-weight: 700;
            line-height: 1;
        }
        
        .event-date .month {
            font-size: 0.8rem;
            text-transform: uppercase;
        }
        
        .event-content h3 {
            margin: 15px 0 10px;
            font-size: 1.3rem;
        }
        
        .event-content p {
            margin-bottom: 15px;
            color: #666;
            font-size: 0.95rem;
        }
        
        .event-content .event-meta {
            margin-bottom: 15px;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }
        
        .pagination a {
            display: inline-block;
            padding: 8px 16px;
            margin: 0 5px;
            border-radius: 4px;
            background-color: white;
            color: #333;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .pagination a.active {
            background-color: #2a7de1;
            color: white;
        }
        
        .pagination a.next {
            padding: 8px 20px;
        }
        
        .pagination a:hover {
            background-color: #f0f0f0;
        }
        
        .pagination a.active:hover {
            background-color: #2a7de1;
        }
        
        .past-events-slider {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding: 20px 0;
            scroll-snap-type: x mandatory;
        }
        
        .past-event {
            position: relative;
            min-width: 300px;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
            scroll-snap-align: start;
        }
        
        .past-event img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .past-event-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 20px;
        }
        
        .past-event-overlay h3 {
            margin-bottom: 5px;
            font-size: 1.2rem;
        }
        
        .past-event-overlay p {
            margin-bottom: 10px;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .host-event {
            background-color:rgb(6, 8, 11);
            color: white;
            padding: 60px 0;
        }
        
        .host-event-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .host-event-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        
        .host-event-content p {
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .host-event .btn-primary {
            background-color: white;
            color: #2a7de1;
        }
        
        .host-event .btn-primary:hover {
            background-color: #f0f0f0;
        }
        
        @media screen and (max-width: 992px) {
            .featured-event {
                grid-template-columns: 1fr;
            }
            
            .featured-image {
                height: 300px;
            }
            
            .events-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }
        
        @media screen and (max-width: 768px) {
            .filter-container {
                flex-direction: column;
                gap: 15px;
            }
            
            .filter-group {
                width: 100%;
            }
            
            .filter-btn {
                width: 100%;
            }
            
            .page-header h1 {
                font-size: 2.5rem;
            }
            
            .featured-content h3 {
                font-size: 1.5rem;
            }
            
            .event-details {
                grid-template-columns: 1fr;
            }
        }
        
        @media screen and (max-width: 480px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .past-event {
                min-width: 250px;
            }
        }
    </style>
</body>
</html>