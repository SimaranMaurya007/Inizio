<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Event Registration</title>
    <?php require 'utils/styles.php'; ?>
    <?php require 'utils/scripts.php'; ?>
</head>
<body>
    <?php require 'utils/header.php'; ?>
    <div class="content">
        <div class="container">
            
            <?php
            require_once 'classes/EventTableGateway.php';
            require_once 'classes/Connection.php';
            $eventDetails = null;
            $eventIdPrefill = isset($_GET['event_id']) ? htmlspecialchars($_GET['event_id']) : '';
            if ($eventIdPrefill) {
                $connection = Connection::getInstance();
                $gateway = new EventTableGateway($connection);
                $statement = $gateway->getEventsById($eventIdPrefill);
                $eventDetails = $statement->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php if ($eventDetails) { ?>
            <div class="container">
                <h2>Event Details</h2>
                <table class="table table-bordered">
                    <tr><th>Title</th><td><?php echo htmlspecialchars($eventDetails['Title']); ?></td></tr>
                    <tr><th>Description</th><td><?php echo htmlspecialchars($eventDetails['Description']); ?></td></tr>
                    <tr><th>Start Date</th><td><?php echo htmlspecialchars($eventDetails['StartDate']); ?></td></tr>
                    <tr><th>End Date</th><td><?php echo htmlspecialchars($eventDetails['EndDate']); ?></td></tr>
                    <tr><th>Cost</th><td><?php echo htmlspecialchars($eventDetails['Cost']); ?></td></tr>
                </table>
            </div>
            <?php } ?>
            <div class="container">
                <h1>Event Registration</h1>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <form action="registerEvent.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label for="Name" class="col-md-2 control-label">Name</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="Name" name="Name" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Email" class="col-md-2 control-label">Email</label>
                    <div class="col-md-5">
                        <input type="email" class="form-control" id="Email" name="Email" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Phone" class="col-md-2 control-label">Phone</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="Phone" name="Phone" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="EventID" class="col-md-2 control-label">Event ID</label>
                    <div class="col-md-5">
                        <input type="text" class="form-control" id="EventID" name="EventID" required value="<?php echo $eventIdPrefill; ?>" <?php if ($eventIdPrefill) echo 'readonly'; ?> />
                    </div>
                </div>
                <div class="form-group">
                    <label for="Comments" class="col-md-2 control-label">Comments</label>
                    <div class="col-md-5">
                        <textarea class="form-control" id="Comments" name="Comments" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-10">
                        <button type="submit" class="btn btn-default">Register</button>
                        <a class="btn btn-default" href="viewEvents.php">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <?php require 'utils/footer.php'; ?>

        
        
