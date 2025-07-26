<?php
require_once 'utils/session_init.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';

$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);
$statement = $gateway->getEvents();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>All Upcoming Events</title>
    <?php require 'utils/styles.php'; ?>
    <?php require 'utils/scripts.php'; ?>
</head>
<body>
<?php require 'utils/header.php'; ?>
<?php if (isset($_SESSION['user']) && in_array($_SESSION['user']->getRole(), ['admin', 'organizer'])) { ?>
    <div class="container" style="margin-bottom:20px;">
        <a class="btn btn-primary" href="createEventForm.php">Create Event</a>
    </div>
<?php } ?>
<div class="container">
    <h1>All Upcoming Events</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Cost</th>
                <th>Location</th>
                <th>Details</th>
                <th>Register</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                echo '<tr>';
                echo '<td>' . $row['EventID'] . '</td>';
                echo '<td>' . htmlspecialchars($row['Title']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Description']) . '</td>';
                echo '<td>' . htmlspecialchars($row['StartDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['EndDate']) . '</td>';
                echo '<td>' . htmlspecialchars($row['Cost']) . '</td>';
                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                echo '<td><a href="viewEvent.php?id=' . $row['EventID'] . '">View Details</a></td>';
                echo '<td><a class="btn btn-success" href="event_register.php?event_id=' . $row['EventID'] . '">Register</a></td>';
                echo '</tr>';
                $row = $statement->fetch(PDO::FETCH_ASSOC);
            }
            ?>
        </tbody>
    </table>
</div>
<?php require 'utils/footer.php'; ?>
</body>
</html> 