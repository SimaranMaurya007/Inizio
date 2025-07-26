<?php
require_once 'classes/DB.php';

function getLocationName($conn, $locationId) {
    $stmt = $conn->prepare('SELECT Name FROM locations WHERE LocationID = ?');
    $stmt->execute([$locationId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['Name'] : 'Unknown';
}

if (!isset($_GET['event_id'])) {
    die('No event ID provided.');
}
$eventId = intval($_GET['event_id']);

try {
    require_once 'classes/Connection.php';
$conn = Connection::getInstance();
    $stmt = $conn->prepare('SELECT * FROM events WHERE EventID = ?');
    $stmt->execute([$eventId]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$event) {
        $notFound = true;
    } else {
        $notFound = false;
        $locationName = getLocationName($conn, $event['LocationID']);
    }
} catch (Exception $e) {
    die('Database error.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Details</title>
    <?php require 'utils/styles.php'; ?>
    <?php require 'utils/scripts.php'; ?>
    <style>
    .event-details-panel {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        margin: 40px auto;
        max-width: 800px;
        padding: 0;
        overflow: hidden;
    }
    .event-details-image {
        width: 100%;
        max-height: 350px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }
    .event-details-body {
        padding: 32px 40px;
    }
    .event-details-title {
        font-size: 2.2em;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .event-details-meta {
        color: #888;
        margin-bottom: 18px;
    }
    .event-details-description {
        margin-bottom: 18px;
        font-size: 1.1em;
    }
    @media (max-width: 600px) {
        .event-details-body { padding: 16px 10px; }
        .event-details-title { font-size: 1.3em; }
    }
    </style>
</head>
<body>
<?php require 'utils/header.php'; ?>
<div class="container">
    <?php if ($notFound): ?>
        <div class="alert alert-danger" style="margin-top:40px;">Event not found.</div>
    <?php else: ?>
        <div class="event-details-panel">
            <?php $img = !empty($event['image']) ? htmlspecialchars($event['image']) : 'images/bdayevent.jpg'; ?>
            <img src="<?php echo $img; ?>" alt="Event Image" class="event-details-image img-responsive">
            <div class="event-details-body">
                <div class="event-details-title"><?php echo htmlspecialchars($event['Title']); ?></div>
                <div class="event-details-meta">
                    <span><strong>Date:</strong> <?php echo htmlspecialchars($event['StartDate']); ?><?php if ($event['EndDate'] && $event['EndDate'] != $event['StartDate']) echo ' to ' . htmlspecialchars($event['EndDate']); ?></span><br>
                    <span><strong>Cost:</strong> <?php echo htmlspecialchars($event['Cost']); ?></span><br>
                    <span><strong>Location:</strong> <?php echo htmlspecialchars($locationName); ?></span>
                </div>
                <div class="event-details-description">
                    <?php echo htmlspecialchars($event['Description']); ?>
                </div>
                <a href="events2.php" class="btn btn-default">Back to Events</a>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php require 'utils/footer.php'; ?>
</body>
</html> 