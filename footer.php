<?php
require_once 'functions.php';
start_session_if_not_started();
?>

<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Entrepreneurs Club</h3>
                <p>Connecting entrepreneurs worldwide.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="members.php">Members</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <p>Email: <a href="2004rohitvishu@gmail.com">2004rohitvishu@gmail.com</a></p>
                <p>Phone: <a href="+919521757508">+919521757508</a></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Entrepreneurs Club. All rights reserved.</p>
        </div>
    </div>
</footer>

</body>
</html>

<style>
/* Footer Styles */
footer {
    background: linear-gradient(135deg, #2a7de1, #1a5bb8);
    color: white;
    padding: 40px 0;
    margin-top: 40px;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.footer-section h3 {
    margin-bottom: 15px;
    color: #fff;
    font-size: 1.2rem;
    font-weight: bold;
}

.footer-section p, .footer-section ul li {
    margin-bottom: 10px;
    color: #d9e8fc;
    font-size: 0.9rem;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li a {
    color:rgb(226, 234, 243);
    text-decoration: none;
    font-size: 0.9rem;
}

.footer-section ul li a:hover {
    text-decoration: underline;
    color: #fff;
}

.footer-bottom {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255, 255, 255, 0.2);
}

.footer-bottom p {
    margin: 0;
    color: #d9e8fc;
    font-size: 0.85rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .footer-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .footer-section {
        margin-bottom: 20px;
    }
}
</style>