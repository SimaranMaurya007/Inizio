<?php
// Test script to verify session functionality
if (!ob_get_level()) {
    ob_start();
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once 'utils/functions.php';

echo "Session test successful!<br>";
echo "Session ID: " . session_id() . "<br>";
echo "Logged in: " . (is_logged_in() ? 'Yes' : 'No') . "<br>";

ob_end_flush();
?> 