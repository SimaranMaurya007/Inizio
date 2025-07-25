<?php
function validateSponsor($input_method, &$formdata, &$errors) {
    $formdata['Name'] = filter_input($input_method, "Name", FILTER_SANITIZE_STRING);
    $formdata['Address'] = filter_input($input_method, "Address", FILTER_SANITIZE_STRING);
    $formdata['ManagerFName'] = filter_input($input_method, "ManagerFName", FILTER_SANITIZE_STRING);
    $formdata['ManagerLName'] = filter_input($input_method, "ManagerLName", FILTER_SANITIZE_STRING);
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
