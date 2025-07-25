<?php
require_once 'functions.php';

if (!isset($formdata)) {
    $formdata = array();
}

if (!isset($errors)) {
    $errors = array();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sponsor Form</title>
        <style>
            span.error{
                color: red;
            }            
        </style>  
        <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
        <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
    </head>
    <body>
        <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
        <div class="content">
            <div class="container">
                <h1>Sponsor Form</h1><!--form title-->

                <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
                <?php 
                if (isset($errorMessage)) {
                    echo '<p>Error: ' . $errorMessage . '</p>';
                }
                ?>
                <form action="createSponsor.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Name" class="col-md-2 control-label">Sponsor Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Name" name="Name" value="<?php echoValue($formdata, "Name")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="LNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Name');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Address" class="col-md-2 control-label">Address</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="Address" name="Address" value="<?php echoValue($formdata, "Address")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="LAddressError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'Address');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="managerFName" class="col-md-2 control-label">Manager First Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="managerFName" name="ManagerFName" value="<?php echoValue($formdata, "ManagerFName")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerFName');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="managerLName" class="col-md-2 control-label">Manager Last Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="managerLName" name="ManagerLName" value="<?php echoValue($formdata, "ManagerLName")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="mNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerLName');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="managerEmail" class="col-md-2 control-label">Manager Email</label>
                        <div class="col-md-5">
                            <input type="email" class="form-control" id="managerEmail" name="ManagerEmail" value="<?php echoValue($formdata, "ManagerEmail")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="mEmailError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerEmail');?>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="managerPhone" class="col-md-2 control-label">Manager Contact</label>
                        <div class="col-md-5">
                            <input type="phone" class="form-control" id="managerPhone" name="PhoneNumber" value="<?php echoValue($formdata, "PhoneNumber")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="mPhoneError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'managerPhone');?>
                            </span>
                        </div>
                    </div>
                    
                    

                <!--codes below has no connection with the database.-->
                    
                    <div class="form-group">
                        <label class="col-md-2 control-label">Logo:</label>
                        <div class="col-md-5">
                            <input type="file" class="control-label" name="Image" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                    <label for="managerLinkedIn" class="col-md-2 control-label">Manager LinkedIn</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="managerLinkedIn" name="managerLinkedIn" value="<?php echoValue($formdata, "managerLinkedIn")?>" /><!--input-->
                    </div>
                    <div class="col-md-4">
                        <span id="managerLinkedInError" class="error"><!--error message for invalid input-->
                            <?php echoValue($errors, 'managerLinkedIn');?>
                        </span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="sponsorEvents" class="col-md-2 control-label">Events Sponsored</label>
                    <div class="col-md-5">
                        <input type="checkbox" id="sponsorEvents" name="sponsorEvents" onchange="showEventsFields(this.checked);" /> Yes
                    </div>
                </div>
                <div id="eventsFields" style="display: none;">
                    <div class="form-group">
                        <label for="eventName" class="col-md-2 control-label">Event Name</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echoValue($formdata, "eventName")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="eventNameError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'eventName');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="eventOwner" class="col-md-2 control-label">Event Owner</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="eventOwner" name="eventOwner" value="<?php echoValue($formdata, "eventOwner")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="eventOwnerError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'eventOwner');?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fundsProvided" class="col-md-2 control-label">Funds Provided</label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" id="fundsProvided" name="fundsProvided" value="<?php echoValue($formdata, "fundsProvided")?>" /><!--input-->
                        </div>
                        <div class="col-md-4">
                            <span id="fundsProvidedError" class="error"><!--error message for invalid input-->
                                <?php echoValue($errors, 'fundsProvided');?>
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" name="createSponsor" class="btn btn-default pull-right">Add Sponsor <span class="glyphicon glyphicon-send"></span></button>
            </form>
            <a class="btn btn-default" href="viewSponsor.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a><!--return/back button-->
            <!-- <a class="btn btn-default" href="viewSponsors.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>return/back button -->
        </div>
        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    
        <?php require 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
    </div>

    
        <script>
        function showEventsFields(checked) {
            var eventsFields = document.getElementById('eventsFields');
            eventsFields.style.display = checked ? 'block' : 'none';
        }
    </script>

    </body>
</html>
