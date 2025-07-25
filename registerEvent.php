<?php
require_once 'classes/Connection.php';
session_start();

// Validate POST data
$name = isset($_POST['Name']) ? trim($_POST['Name']) : '';
$email = isset($_POST['Email']) ? trim($_POST['Email']) : '';
$phone = isset($_POST['Phone']) ? trim($_POST['Phone']) : '';
$event_id = isset($_POST['EventID']) ? trim($_POST['EventID']) : '';
$comments = isset($_POST['Comments']) ? trim($_POST['Comments']) : '';

$errors = array();
if ($name === '') $errors[] = 'Name is required.';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if ($phone === '') $errors[] = 'Phone is required.';
if ($event_id === '' || !is_numeric($event_id)) $errors[] = 'Valid Event ID is required.';

// Get user_id if logged in
$user_id = null;
if (isset($_SESSION['user']) && isset($_SESSION['user']->id)) {
    $user_id = $_SESSION['user']->id;
}

if (count($errors) === 0) {
    $connection = Connection::getInstance();
    $sql = "INSERT INTO attendees (event_id, user_id, name, email, phone, comments) VALUES (:event_id, :user_id, :name, :email, :phone, :comments)";
    $stmt = $connection->prepare($sql);
    $params = array(
        'event_id' => $event_id,
        'user_id' => $user_id,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'comments' => $comments
    );
    $success = $stmt->execute($params);
    if ($success) {
        header('Location: event_register.php?success=1');
        exit();
    } else {
        $errors[] = 'Registration failed. Please try again.';
    }
}

// If errors, show the registration form again with errors
$_REQUEST['errors'] = $errors;
require 'event_register.php'; 