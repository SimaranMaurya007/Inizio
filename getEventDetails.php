<?php
require_once 'classes/DB.php';
header('Content-Type: application/json');

if (!isset($_GET['event_id'])) {
    echo json_encode(['error' => 'No event ID provided']);
    exit;
}

$eventId = intval($_GET['event_id']);

try {
    $conn = DB::getConnection();
    $stmt = $conn->prepare('SELECT Title, Description, StartDate, EndDate FROM events WHERE EventID = ?');
    $stmt->execute([$eventId]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($event) {
        echo json_encode($event);
    } else {
        echo json_encode(['error' => 'Event not found']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Database error']);
} 