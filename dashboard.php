<?php
ob_start(); // Start output buffering to prevent "headers already sent" errors
require_once 'utils/functions.php';
require_once 'classes/Connection.php';
require_once 'classes/EventTableGateway.php';

start_session();
if (!is_logged_in()) {
    header('Location: login_form.php');
    exit();
}
$user = $_SESSION['user'];
$role = $user->getRole();
$connection = Connection::getInstance();
$eventGateway = new EventTableGateway($connection);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
<?php require 'utils/header.php'; ?>
<div class="container">
    <h1>Dashboard</h1>
    <?php if ($role === 'admin' || $role === 'organizer') { ?>
        <a class="btn btn-primary" href="createEventForm.php" style="margin-bottom:20px;">Create Event</a>
    <?php } ?>
    <?php if ($role === 'admin') { ?>
        <h3>Admin Panel</h3>
        <ul>
            <li><a href="viewEvents.php">Manage All Events</a></li>
            <li><a href="viewLocations.php">Manage Locations</a></li>
            <li><a href="viewSponsor.php">Manage Sponsors</a></li>
            <li><a href="download_attendees.php">Download Attendees</a></li>
            <!-- Add user management link if needed -->
        </ul>
    <?php } elseif ($role === 'organizer') { ?>
        <h3>Organizer Panel</h3>
        <ul>
            <li><a href="viewEvents.php">Manage My Events</a></li>
            <li><a href="download_attendees.php">Download Attendees</a></li>
        </ul>
        <!-- Optionally, list their events here -->
    <?php } else { ?>
        <h3>My Event Registrations</h3>
        <ul>
            <li><a href="viewEvents.php">Browse Events</a></li>
            <!-- Optionally, show a list of events this user has registered for -->
        </ul>
    <?php } ?>
</div>
<?php require 'utils/footer.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?> 