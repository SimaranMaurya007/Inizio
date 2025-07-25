<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'classes/Sponsor.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateSponsor.php';

$formdata = array();
$errors = array();

validateSponsor(INPUT_POST, $formdata, $errors);

if (empty($errors)) {
    $sponsorName = $formdata['Name'];
    $sponsorAddress = $formdata['Address'];    
    $managerFName = $formdata['ManagerFName'];
    $managerLName = $formdata['ManagerLName'];
    $managerEmail = $formdata['ManagerEmail'];
    $phoneNumber = $formdata['PhoneNumber'];

    // Handle image upload
    $imageFileName = null;
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'images/sponsors/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $ext = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION);
        $imageFileName = uniqid('sponsor_', true) . '.' . $ext;
        $uploadFile = $uploadDir . $imageFileName;
        move_uploaded_file($_FILES['Image']['tmp_name'], $uploadFile);
    }

    $sponsor = new Sponsor(-1, $sponsorName, $sponsorAddress, $managerFName, $managerLName, $managerEmail, $phoneNumber, $imageFileName);

    $connection = Connection::getInstance();

    $gateway = new SponsorTableGateway($connection);

    $id = $gateway->insert($sponsor);

    header('Location: homeIn.php');
} else {
    require 'createSponsorForm.php';
}
?>
