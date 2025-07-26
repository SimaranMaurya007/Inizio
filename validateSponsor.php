<?php
function validateSponsor($input_method, &$formdata, &$errors) {
    $formdata['Name'] = htmlspecialchars($_POST['Name'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['Address'] = htmlspecialchars($_POST['Address'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['ManagerFName'] = htmlspecialchars($_POST['ManagerFName'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['ManagerLName'] = htmlspecialchars($_POST['ManagerLName'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['ManagerEmail'] = filter_input($input_method, "ManagerEmail", FILTER_SANITIZE_EMAIL);
    $formdata['PhoneNumber'] = filter_input($input_method, "PhoneNumber", FILTER_SANITIZE_NUMBER_INT);

    if (empty($formdata['Name'])) {
        $errors['Name'] = "Name is required";
    }

    if (empty($formdata['Address'])) {
        $errors['Address'] = "Address is required";
    }

    if (empty($formdata['ManagerFName'])) {
        $errors['ManagerFName'] = "Manager first name is required";
    }

    if (empty($formdata['ManagerLName'])) {
        $errors['ManagerLName'] = "Manager last name is required";
    }

    if (empty($formdata['ManagerEmail']) || !filter_var($formdata['ManagerEmail'], FILTER_VALIDATE_EMAIL)) {
        $errors['ManagerEmail'] = "Valid manager email is required";
    }

    if (empty($formdata['PhoneNumber'])) {
        $errors['PhoneNumber'] = "Manager phone number is required";
    }
}
