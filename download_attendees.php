<?php
require_once 'utils/functions.php';
require_once 'classes/Connection.php';
require_once 'classes/EventTableGateway.php';

start_session();

// Security: Only allow admin or organizer
if (!isset($_SESSION['user']) || !in_array($_SESSION['user']->getRole(), ['admin', 'organizer'])) {
    header('Location: login_form.php');
    exit();
}

$connection = Connection::getInstance();
$eventGateway = new EventTableGateway($connection);
$role = $_SESSION['user']->getRole();
$user_id = $_SESSION['user']->getId();

if ($role === 'organizer') {
    $events = $eventGateway->getEventsByOrganizerId($user_id);
} else {
    $events = $eventGateway->getEvents();
}

// Handle CSV download
if (isset($_GET['event_id']) && is_numeric($_GET['event_id'])) {
    $event_id = intval($_GET['event_id']);
    // Security: Only allow download if admin or this organizer owns the event
    if ($role === 'organizer') {
        $stmtCheck = $connection->prepare("SELECT COUNT(*) FROM events WHERE EventID = :event_id AND organizer_id = :organizer_id");
        $stmtCheck->execute(['event_id' => $event_id, 'organizer_id' => $user_id]);
        if ($stmtCheck->fetchColumn() == 0) {
            die('Unauthorized.');
        }
    }
    $stmt = $connection->prepare("SELECT name, email, phone, comments, registered_at FROM attendees WHERE event_id = :event_id");
    $stmt->execute(['event_id' => $event_id]);
    $attendees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="attendees_event_' . $event_id . '.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Name', 'Email', 'Phone', 'Comments', 'Registered At']);
    foreach ($attendees as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Download Attendee List</title>
    <?php require 'utils/styles.php'; ?>
</head>
<body>
<?php require 'utils/header.php'; ?>
<div class="container">
    <h1>Download Attendee List (CSV)</h1>
    <form method="get" action="download_attendees.php" class="form-inline">
        <div class="form-group">
            <label for="event_id">Select Event:</label>
            <select name="event_id" id="event_id" class="form-control" required>
                <option value="">-- Select Event --</option>
                <?php while ($event = $events->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $event['EventID'] . '">' . htmlspecialchars($event['Title']) . '</option>';
                } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Download CSV</button>
    </form>
</div>
<?php require 'utils/footer.php'; ?>
</body>
</html> 