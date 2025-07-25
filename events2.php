<?php
require_once 'classes/DB.php';

// Fetch events from the database
try {
    $conn = DB::getConnection();
    $stmt = $conn->prepare('SELECT EventID, Title, Description, StartDate, EndDate, Cost, LocationID, image FROM events');
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $events = [];
}

function getLocationName($conn, $locationId) {
    $stmt = $conn->prepare('SELECT Name FROM locations WHERE LocationID = ?');
    $stmt->execute([$locationId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['Name'] : 'Unknown';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Events</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
        <style>
        .event-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            margin-bottom: 40px;
            padding: 0;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
        }
        .event-image {
            width: 100%;
            max-width: 320px;
            height: 220px;
            object-fit: cover;
            border-radius: 10px 0 0 10px;
        }
        .event-details {
            padding: 24px 32px;
            flex: 1 1 300px;
        }
        .event-title {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 2em;
            font-weight: bold;
        }
        .event-meta {
            color: #888;
            margin-bottom: 10px;
        }
        .event-description {
            margin-bottom: 16px;
        }
        @media (max-width: 768px) {
            .event-card { flex-direction: column; }
            .event-image { border-radius: 10px 10px 0 0; max-width: 100%; }
        }
        </style>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <div class="container" style="margin-top:40px;">
            <h1 class="text-center">What's On</h1>
            <hr>
            <?php foreach ($events as $event): ?>
                <div class="event-card row">
                    <div class="col-md-4 col-sm-12" style="padding:0;">
                        <?php 
                        $img = !empty($event['image']) ? htmlspecialchars($event['image']) : 'images/bdayevent.jpg';
                        ?>
                        <img src="<?php echo $img; ?>" alt="Event Image" class="event-image img-responsive">
                    </div>
                    <div class="event-details col-md-8 col-sm-12">
                        <div class="event-title"><?php echo htmlspecialchars($event['Title']); ?></div>
                        <div class="event-meta">
                            <span><strong>Date:</strong> <?php echo htmlspecialchars($event['StartDate']); ?><?php if ($event['EndDate'] && $event['EndDate'] != $event['StartDate']) echo ' to ' . htmlspecialchars($event['EndDate']); ?></span><br>
                            <span><strong>Cost:</strong> <?php echo htmlspecialchars($event['Cost']); ?></span><br>
                            <span><strong>Location:</strong> <?php echo htmlspecialchars(getLocationName($conn, $event['LocationID'])); ?></span>
                        </div>
                        <div class="event-description">
                            <?php echo htmlspecialchars($event['Description']); ?>
                        </div>
                        <button type="button" class="btn btn-info btn-lg" onclick="window.location.href='event_details.php?event_id=<?php echo $event['EventID']; ?>'">
                            View Details <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php require 'utils/footer.php'; ?>
    </body>
</html>
