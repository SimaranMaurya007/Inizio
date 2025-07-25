<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';


$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);

$statement = $gateway->getEvents();

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];
$role = $user->getRole();

$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';

if ($role === 'organizer') {
    // Only show events created by this organizer
    $statement = $gateway->getEventsByOrganizerId($user->getId());
} elseif (!empty($searchName)) {
    $statement = $gateway->getEventByName($searchName);
} else {
    $statement = $gateway->getEvents();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php $showHeroSection = false; require 'utils/header.php'; ?>
        <div class = "content">
            <div class = "container">
                <h1>Your Events</h1>
                <form method="GET" action="">
                <div class="form-group">
                    <label for="searchName">Search Event:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Enter Event by Name">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
                <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event ID</th>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $row['EventID'] . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';
                            echo '<td>' . $row['Description'] . '</td>';                    
                            echo '<td>' . $row['StartDate'] . '</td>';
                            echo '<td>' . $row['EndDate'] . '</td>';
                            echo '<td>' . $row['Cost'] . '</td>';
                            echo '<td>'
                            . '<a href="viewLocation.php?id='.$row['LocationID'].'">'.$row['name'].'</a> '
                            . '</td>';
                            echo '<td>'
                            . '<a href="viewEvent.php?id='.$row['EventID'].'">View</a> ';
                            if ($role === 'admin' || $role === 'organizer') {
                                // Only admins or organizers can see Edit/Delete
                                // echo '<a href="editEvent.php?id='.$row['EventID'].'">Edit</a> ';
                                echo '<a class="delete" href="deleteEvent.php?id='.$row['EventID'].'">Delete</a> ';
                            }
                            echo '</td>';
                            echo '</tr>';  

                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
                <?php if ($role === 'admin' || $role === 'organizer') { ?>
                    <a class="btn btn-default" href = "createEventForm.php">Create Event</a><!--register button-->
                <?php } ?>
            </div>
            <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

            <?php require 'utils/footer.php'; ?>
        </div>
        
       
    </body>
</html>
