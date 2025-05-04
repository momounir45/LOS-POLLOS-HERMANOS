<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'testo');
define('DB_USER', 'root'); // Change to your database username
define('DB_PASS', ''); // Change to your database password

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}