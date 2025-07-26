<?php

function validateEvents($input_method, &$formdata, &$errors) {
    $formdata['Title'] = htmlspecialchars($_POST['Title'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['Description'] = htmlspecialchars($_POST['Description'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['StartDate'] = htmlspecialchars($_POST['StartDate'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['EndDate'] = htmlspecialchars($_POST['EndDate'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['Cost'] = filter_input($input_method, "Cost", FILTER_SANITIZE_NUMBER_INT);
    $formdata['LocID'] = filter_input($input_method, "LocID", FILTER_SANITIZE_NUMBER_INT);

    if ($formdata['Title'] === NULL ||
                    $formdata['Title'] === FALSE ||
                    $formdata['Title'] === "")
    {
        $errors['Title'] = "Title required";
    }
    
    if ($formdata['Description'] === NULL ||
                    $formdata['Description'] === FALSE ||
                    $formdata['Description'] === "")
    {
        $errors['Description'] = "Description (event details) is required";
    }   
    
    if ($formdata['StartDate'] === NULL ||
                    $formdata['StartDate'] === FALSE ||
                    $formdata['StartDate'] === "")
    {
        $errors['StartDate'] = "Start Date  required";
    }
    
    if ($formdata['EndDate'] === NULL ||
                    $formdata['EndDate'] === FALSE ||
                    $formdata['EndDate'] === "")
    {
        $errors['EndDate'] = "End Date required";
    }
    
    if ($formdata['Cost'] === ""){
        $capacity = intval($formdata['Cost']);
        if ($capacity < 0 || $capacity > 999999) {
    }
        $errors['Cost'] = "Cost required. Cannot be a negative value";
    }
    
    if ($formdata['LocID'] === ""){
        $locID = intval($formdata['LocID']);
        if ($locID < 0 || $capacity > 999999) {
    }
        $errors['LocID'] = "LocationID required. Cannot be a negative value";
    }
    
}
