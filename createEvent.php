<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateEvents.php';

session_start();

$formdata = array();
$errors = array();

validateEvents(INPUT_POST, $formdata, $errors);

$event_type = isset($_POST['event_type']) ? $_POST['event_type'] : null;

if (empty($errors)) {
    $title = $formdata['Title'];
    $description = $formdata['Description'];    
    $sDate = $formdata['StartDate'];
    $eDate = $formdata['EndDate'];
    $cost = $formdata['Cost'];
    $locID = $formdata['LocID'];
    $organizer_id = isset($_SESSION['user']) ? $_SESSION['user']->getId() : null;

    $event = new Event(-1, $title, $description, $sDate, $eDate, $cost, $locID, $organizer_id, $event_type);

    $connection = Connection::getInstance();

    $gateway = new EventTableGateway($connection);

    $id = $gateway->insert($event);

    header('Location: viewEvents.php');
}
else {
    require 'createEventForm.php';
}