<?php
// Include session initialization first
require_once 'utils/session_init.php';

require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';


if (!isset($_GET['id'])) {
    die("Illegal request");
}
$id = $_GET['id'];

$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);

$statement = $gateway->getEventsById($id);

$row = $statement->fetch(PDO::FETCH_ASSOC);
if (!$row) {
    die("Illegal request");
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
                <?php 
                if (isset($message)) {
                    echo '<p>'.$message.'</p>';
                }
                ?>
                <table class = "table table-hover">
                    <thead><!--table labels-->
                        <tr>
                            <th>Event ID</th>
                            <th>Title</th>
                            <th>Description</th>                    
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location ID</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody><!--table contents, pulled from database-->
                        <?php
                        echo '<tr>';
                        echo '<td>' . $row['EventID'] . '</td>';
                        echo '<td>' . $row['Title'] . '</td>';
                        echo '<td>' . $row['Description'] . '</td>';                    
                        echo '<td>' . $row['StartDate'] . '</td>';
                        echo '<td>' . $row['EndDate'] . '</td>';
                        echo '<td>' . $row['Cost'] . '</td>';
                        echo '<td>' . $row['LocationID'] . '</td>';
                        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
                        $canDelete = false;
                        if (
                            $user && (
                                $user->getRole() === 'admin' ||
                                ($user->getRole() === 'organizer' && isset($row['organizer_id']) && $row['organizer_id'] == $user->getId())
                            )
                        ) {
                            $canDelete = true;
                        }
                        echo '<td>';
                        if ($canDelete) {
                            echo '<a class="delete" href="deleteEvent.php?id='.$row['EventID'].'">Delete</a> ';
                        }
                        echo '</td>';
                        echo '</tr>';  
                        ?>
                    </tbody>
                </table>
                <!-- Sponsors Section -->
                <div class="container" style="margin-top:20px;">
                    <h3>Sponsors</h3>
                    <p>
                        <a href="viewSponsor.php" class="btn btn-info">View All Sponsors</a>
                    </p>
                    <!-- If you want to show sponsors for this event, add logic here -->
                    <p style="color: #888;">(Sponsor information for this event can be shown here if available.)</p>
                </div>
                <a class="btn btn-default" href="viewEvents.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>
            </div>
            <?php require 'utils/footer.php'; ?>
        </div>
        
    </body>
</html>
