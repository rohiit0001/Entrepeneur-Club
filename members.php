<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members - Entrepreneurs Club</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
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
                    <li><a href="events.php">Events</a></li>
                    <li><a href="members.php" class="active">Members</a></li>
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
            <h1>Our Members</h1>
            <p>Connect with entrepreneurs from various industries and backgrounds</p>
        </div>
    </section>

    <!--<section class="members-search">
        <div class="container">
            <div class="search-container">
                <div class="search-box">
                    <input type="text" placeholder="Search members by name, company, or industry...">
                    <button class="search-btn"><i class="fas fa-search"></i></button>
                </div>
                <div class="filter-toggles">
                    <button class="filter-toggle active" data-filter="all">All Members</button>
                    <button class="filter-toggle" data-filter="featured">Featured</button>
                    <button class="filter-toggle" data-filter="new">New Members</button>
                </div>
            </div>
            <div class="advanced-filters">
                <div class="filter-row">
                    <div class="filter-group">
                        <label for="industry-filter">Industry</label>
                        <select id="industry-filter">
                            <option value="">All Industries</option>
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
                    <div class="filter-group">
                        <label for="location-filter">Location</label>
                        <select id="location-filter">
                            <option value="">All Locations</option>
                            <option value="new-york">New York</option>
                            <option value="san-francisco">San Francisco</option>
                            <option value="chicago">Chicago</option>
                            <option value="boston">Boston</option>
                            <option value="los-angeles">Los Angeles</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="experience-filter">Experience Level</label>
                        <select id="experience-filter">
                            <option value="">All Levels</option>
                            <option value="startup">Startup Founder</option>
                            <option value="serial">Serial Entrepreneur</option>
                            <option value="corporate">Corporate Executive</option>
                            <option value="investor">Investor</option>
                            <option value="student">Student Entrepreneur</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary apply-filters">Apply Filters</button>
            </div>
        </div>
    </section>-->

    <section class="featured-members">
        <div class="container">
            <h2 class="section-title">Featured Members</h2>
            <div class="featured-members-grid">
                <div class="featured-member">
                    <div class="member-banner" style="background-image: url('img11.jpg');"></div>
                    <div class="member-avatar">
                        <img src="img111.webp" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Aadit Palicha</h3>
                        <p class="member-title">Co-founders of Zepto</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> Online grocery delivery</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i>  Mumbai, India</p>
                        <p class="member-bio">Indian entrepreneur who dropped out of Stanford to start Zepto, an online grocery and food delivery company. </p>
                        <div class="member-actions">
                          <!--  <a href="profile.php?id=1" class="btn btn-secondary">View Profile</a>-->
                            <a href="https://www.linkedin.com/in/aadit-palicha/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="featured-member">
                    <div class="member-banner" style="background-image: url('img11.jpg');"></div>
                    <div class="member-avatar">
                        <img src="img222.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Peyush Bansal</h3>
                        <p class="member-title">Founder of Lenskart</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> E-Commerce</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i>  Haryana, India</p>
                        <p class="member-bio">Is an Indian entrepreneur, business executive and angel investor. He is the co-founder and CEO of Lenskart.</p>
                        <div class="member-actions">
                          <!--  <a href="profile.php?id=2" class="btn btn-secondary">View Profile</a>-->
                            <a href="https://www.linkedin.com/in/peyushbansal/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="featured-member">
                    <div class="member-banner" style="background-image: url('img11.jpg');"></div>
                    <div class="member-avatar">
                        <img src="img333.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3> Ghazal Alagh</h3>
                        <p class="member-title">Founder Mamaearth</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> personal care and beauty industry</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i>  Haryana, India</p>
                        <p class="member-bio">Healthcare innovator with a passion for improving patient outcomes through technology.</p>
                        <div class="member-actions">
                          <!--  <a href="profile.php?id=3" class="btn btn-secondary">View Profile</a>-->
                            <a href="hhttps://www.linkedin.com/in/ghazal-alagh-aa247912a/?originalSubdomain=in" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="all-members">
        <div class="container">
            <h2 class="section-title">All Members</h2>
            <div class="members-grid">
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img7.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Kush Taneja</h3>
                        <p class="member-title">Founder, FamPay</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> Fintech (Teen-focused digital payments)</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> India (Bengaluru)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/in/iamkushtaneja/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img6.avif" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Ankur Warikoo</h3>
                        <p class="member-title">Founder ,WebVeda</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> EdTech (Online learning for professionals)</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> India (Delhi)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/in/warikoo/?originalSubdomain=in" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img5.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Aprameya Radhakrishna</h3>
                        <p class="member-title">Founder Koo</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> Social Media</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> India (Bengaluru)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/in/aprameyaradhakrishna/?originalSubdomain=in" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img4.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Akshay Kothari</h3>
                        <p class="member-title">Founder, Notion</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> Productivity Software</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> San Francisco Bay Area, USA</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/in/akothari/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img3.jpg" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3> Richa Kar</h3>
                        <p class="member-title">Founder, Zivame</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> E-commerce (Lingerie and fashion retail)</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> India (Bengaluru, Karnataka)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/in/richa-kar/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img2.webp" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Falguni Nayar</h3>
                        <p class="member-title">Founder, Nykaa</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> E-commerce (Beauty and wellness retail)</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> India (Mumbai, Maharashtra)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/pulse/from-falguni-nayar-arundhati-bhattacharya-leaders-who-have-j51af/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
                <div class="member-card">
                    <div class="member-avatar">
                        <img src="img1.webp" alt="Member">
                    </div>
                    <div class="member-info">
                        <h3>Whitney Wolfe Herd</h3>
                        <p class="member-title">Founder, Bumble</p>
                        <p class="member-industry"><i class="fas fa-briefcase"></i> Tech / Social Media (Online dating app)</p>
                        <p class="member-location"><i class="fas fa-map-marker-alt"></i> USA (Austin, Texas)</p>
                        <div class="member-actions">
                            <a href="https://www.linkedin.com/posts/bumbleinc_whitney-wolfe-herd-founded-bumble-nearly-activity-7127309009753137152-gZoa/" class="btn btn-primary connect-btn">Connect</a>
                        </div>
                    </div>
                </div>
                
               
            </div>
            
            
        </div>
    </section>

    <section class="join-cta">
        <div class="container">
            <div class="join-content">
                <h2>Ready to Join Our Community?</h2>
                <p>Connect with fellow entrepreneurs, attend exclusive events, and grow your business network.</p>
                <a href="register.php" class="btn btn-primary">Become a Member</a>
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
                    <p>Phone: 9521757508</p>
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
        /* Members Page Styles */
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../assets/images/members-header.jpg');
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
        
        .members-search {
            background-color: white;
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .search-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .search-box {
            flex: 1;
            display: flex;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 50px 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        
        .search-btn {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #2a7de1;
            font-size: 1.2rem;
            cursor: pointer;
        }
        
        .filter-toggles {
            display: flex;
            gap: 10px;
        }
        
        .filter-toggle {
            padding: 10px 15px;
            background: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-toggle.active {
            background-color: #2a7de1;
            color: white;
            border-color: #2a7de1;
        }
        
        .advanced-filters {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
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
        
        .apply-filters {
            padding: 10px 20px;
        }
        
        .featured-members, .all-members {
            padding: 80px 0;
        }
        
        .all-members {
            background-color: #f9f9f9;
        }
        
        .featured-members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .featured-member {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }
        
        .featured-member:hover {
            transform: translateY(-10px);
        }
        
        .member-banner {
            height: 120px;
            background-size: cover;
            background-position: center;
        }
        
        .member-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: -50px auto 0;
            overflow: hidden;
            border: 5px solid white;
            position: relative;
            z-index: 1;
        }
        
        .member-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .member-info {
            padding: 20px;
            text-align: center;
        }
        
        .member-info h3 {
            margin: 10px 0 5px;
            font-size: 1.5rem;
        }
        
        .member-title {
            color: #2a7de1;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .member-industry, .member-location {
            color: #666;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        
        .member-industry i, .member-location i {
            margin-right: 5px;
            color: #2a7de1;
        }
        
        .member-bio {
            margin: 15px 0;
            font-size: 0.95rem;
            line-height: 1.6;
        }
        
        .member-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        
        .member-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        
        .member-card:hover {
            transform: translateY(-10px);
        }
        
        .member-card .member-avatar {
            margin: 0 0 15px;
            width: 80px;
            height: 80px;
            border: 3px solid #f0f0f0;
        }
        
        .member-card .member-info {
            padding: 0;
            width: 100%;
        }
        
        .member-card .member-info h3 {
            font-size: 1.2rem;
        }
        
        .member-card .member-title {
            font-size: 0.9rem;
            margin-bottom: 10px;
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
        
        .join-cta {
            background-color: #2a7de1;
            color: white;
            padding: 60px 0;
        }
        
        .join-content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        
        .join-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        
        .join-content p {
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .join-cta .btn-primary {
            background-color: white;
            color: #2a7de1;
        }
        
        .join-cta .btn-primary:hover {
            background-color: #f0f0f0;
        }
        
        @media screen and (max-width: 992px) {
            .search-container {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-toggles {
                justify-content: center;
            }
            
            .featured-members-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            }
        }
        
        @media screen and (max-width: 768px) {
            .page-header h1 {
                font-size: 2.5rem;
            }
            
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .members-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }
        
        @media screen and (max-width: 480px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .members-grid {
                grid-template-columns: 1fr;
            }
            
            .member-actions {
                flex-direction: column;
            }
        }
    </style>
</body>
</html>