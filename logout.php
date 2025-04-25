<?php
// filepath: c:\xampp\htdocs\int219\logout.php

// Start the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page with a logout message
header("Location: login.php?logout=1");
exit();