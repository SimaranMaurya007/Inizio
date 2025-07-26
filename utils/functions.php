<?php
require_once 'classes/User.php';

function is_logged_in() {
    return (isset($_SESSION['user']));
}

function start_session() {
    // Use the standardized session initialization
    require_once 'utils/session_init.php';
}
?>
