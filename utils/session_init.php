<?php
// Session and output buffering initialization
// Include this file at the very beginning of all PHP pages

// Start output buffering if not already started
if (!ob_get_level()) {
    ob_start();
}

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set error reporting to avoid displaying warnings in production
// Uncomment the line below if you want to suppress warnings
// error_reporting(E_ALL & ~E_WARNING);
?> 