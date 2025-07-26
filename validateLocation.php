<?php

function validateLocation($input_method, &$formdata, &$errors) {
    $formdata['Name'] = htmlspecialchars($_POST['Name'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['Address'] = htmlspecialchars($_POST['Address'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['managerFName'] = htmlspecialchars($_POST['managerFName'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['managerLName'] = htmlspecialchars($_POST['managerLName'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['managerEmail'] = filter_input($input_method, "managerEmail", FILTER_SANITIZE_EMAIL);
    $formdata['managerNumber'] = filter_input($input_method, "managerNumber", FILTER_SANITIZE_NUMBER_INT);
    $formdata['maxCap'] = filter_input($input_method, "maxCap", FILTER_SANITIZE_NUMBER_INT);
    $formdata['lType'] = htmlspecialchars($_POST['lType'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['facilities'] = htmlspecialchars($_POST['facilities'] ?? '', ENT_QUOTES, 'UTF-8');
    $formdata['link'] = filter_input($input_method, "link", FILTER_SANITIZE_URL);

    if ($formdata['Name'] === NULL ||
                    $formdata['Name'] === FALSE ||
                    $formdata['Name'] === "")
    {
        $errors['Name'] = "name required";
    }
    
    if ($formdata['Address'] === NULL ||
                    $formdata['Address'] === FALSE ||
                    $formdata['Address'] === "")
    {
        $errors['Address'] = "address required";
    }   
    
    if ($formdata['managerFName'] === NULL ||
                    $formdata['managerFName'] === FALSE ||
                    $formdata['managerFName'] === "")
    {
        $errors['managerFName'] = "first name required";
    }
    
    if ($formdata['managerLName'] === NULL ||
                    $formdata['managerLName'] === FALSE ||
                    $formdata['managerLName'] === "")
    {
        $errors['managerLName'] = "last name required";
    }
    
    if ($formdata['managerEmail'] === NULL ||
                    $formdata['managerEmail'] === FALSE ||
                    $formdata['managerEmail'] === "")
    {
        $errors['managerEmail'] = "manager email required";
    }
    
    if ($formdata['managerNumber'] === NULL ||
                    $formdata['managerNumber'] === FALSE ||
                    $formdata['managerNumber'] === "")
    {
         $errors['managerNumber'] = "manager number required";
    }
    
    if ($formdata['maxCap'] === ""){
        $capacity = intval($formdata['maxCap']);
        if ($capacity < 0 || $capacity > 999999) {
    }
        $errors['maxCap'] = "capacity required. Cannot be a negative value";
    }
    
    if ($formdata['lType'] !== NULL &&
                    $formdata['lType'] !== FALSE &&
                    $formdata['lType'] !== "")
    {
        $type = array("indoor", "outdoor", "both");
        if(!in_array($formdata['lType'], $type)){
            $errors['lType'] = "invalid type";
        }
    }
    
    if ($formdata['facilities'] !== NULL &&
                    $formdata['facilities'] !== FALSE &&
                    $formdata['facilities'] !== "")
    {
        $fcl = array("sound", "screen", "restaurant", "bar", "disabled");
        if(in_array($formdata['facilities'], $fcl)){
            $errors['facilities'] = "invalid restriction";
        }
    }
    
    if ($formdata['link'] !== NULL &&
                    $formdata['link'] !== FALSE &&
                    $formdata['link'] !== "") {
        if (!filter_var($formdata['link'], FILTER_VALIDATE_URL)){
            $errors['link'] = "Invalid url format";
        }
    }
}
