<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);

$statement = $gateway->getLocations();

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];

$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';

if (!empty($searchName)) {
    $statement = $gateway->getLocationByName($searchName);
} else {
    $statement = $gateway->getLocations();
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
            <h1>Your Locations</h1>
            <form method="GET" action="">
                <div class="form-group">
                    <label for="searchName">Search Location:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Enter Location">
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
                <table class ="table table-hover">
                    <thead>
                        <tr>
                            <!--table label-->
                            <!--this will only show the detail of a location with specific ID chosen by the user-->
                            <th>Location ID</th>
                            <th>Name</th>
                            <th>Address</th>                    
                            <th>Manager First Name</th>
                            <th>Manager Last Name</th>
                            <th>Manager Email</th>
                            <th>Manager Number</th>
                            <th>Max Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--table contents-->
                        <?php
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                        while ($row) {
                            echo '<tr>';
                            echo '<td>' . $row['LocationID'] . '</td>';
                            echo '<td>' . $row['Name'] . '</td>';
                            echo '<td>' . $row['Address'] . '</td>';                    
                            echo '<td>' . $row['ManagerFName'] . '</td>';
                            echo '<td>' . $row['ManagerLName'] . '</td>';
                            echo '<td>' . $row['ManagerEmail'] . '</td>';
                            echo '<td>' . $row['ManagerNumber'] . '</td>';
                            echo '<td>' . $row['MaxCapacity'] . '</td>';
                            echo '<td>';
                            echo '<a href="viewLocation.php?id='.$row['LocationID'].'">View</a> ';
                            if ($user->getRole() === 'admin' || ($user->getRole() === 'organizer' && isset($row['organizer_id']) && $row['organizer_id'] == $user->getId())) {
                                echo '<a href="editLocationForm.php?id='.$row['LocationID'].'">Edit</a> ';
                                echo '<a class="delete" href="deleteLocation.php?id='.$row['LocationID'].'">Delete</a> ';
                            }
                            echo '</td>';
                            echo '</tr>';  

                            $row = $statement->fetch(PDO::FETCH_ASSOC);
                        }
                        ?>
                    </tbody>
                </table>
                <?php if ($user->getRole() === 'admin' || $user->getRole() === 'organizer') { ?>
                <a class="btn btn-default" href="createLocationForm.php">Create Location</a>
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
