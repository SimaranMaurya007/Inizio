<?php
require_once 'classes/User.php';

function is_logged_in() {
    return (isset($_SESSION['user']));
}

function start_session() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}
?>
