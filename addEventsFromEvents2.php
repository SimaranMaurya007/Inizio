<?php
require_once 'classes/DB.php';

// Connect to the database
$db = DB::getInstance();
$conn = $db->getConnection();

// Prepare event data from events2.php
$events = [
    [
        'name' => 'Armaan Malik Live',
        'date' => '2024-01-20',
        'location' => 'Main Stage',
        'description' => 'Experience the electrifying beats and soul-stirring melodies at our upcoming concert, where music transcends boundaries and memories are made. Join us for a night of unforgettable performances and camaraderie under the stars',
        'image' => 'images/arman.jpg'
    ],
    [
        'name' => 'The Giggle Fest',
        'date' => '2024-04-20',
        'location' => 'Auditorium',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'image' => 'images/classical.jpg'
    ],
    [
        'name' => 'Standup Comedy Open Mic- Thursday',
        'date' => '2024-06-20',
        'location' => 'Comedy Club',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'image' => 'images/standup.jpg'
    ],
    [
        'name' => 'Career Talk',
        'date' => '2024-08-20',
        'location' => 'UrbanXchange Private Dining Room, The Rocks 12 Argyle Street',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. When an unknown printer took a galley of type and scrambled it to make a type specimen book.',
        'image' => 'images/talk.jpg'
    ]
];

// Check if the events table has an image column
$hasImage = false;
$result = $conn->query("SHOW COLUMNS FROM events LIKE 'image'");
if ($result && $result->num_rows > 0) {
    $hasImage = true;
}

if ($hasImage) {
    $stmt = $conn->prepare("INSERT INTO events (name, date, location, description, image) VALUES (?, ?, ?, ?, ?)");
} else {
    $stmt = $conn->prepare("INSERT INTO events (name, date, location, description) VALUES (?, ?, ?, ?)");
}

foreach ($events as $event) {
    if ($hasImage) {
        $stmt->bind_param('sssss', $event['name'], $event['date'], $event['location'], $event['description'], $event['image']);
    } else {
        $stmt->bind_param('ssss', $event['name'], $event['date'], $event['location'], $event['description']);
    }
    $stmt->execute();
}

$stmt->close();

// Output result

echo "Events from events2.php added successfully!"; 