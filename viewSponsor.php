<?php
// Include session initialization first
require_once 'utils/session_init.php';

require_once 'utils/functions.php';
require_once 'classes/Sponsor.php';
require_once 'classes/SponsorTableGateway.php';
require_once 'classes/Connection.php';

$connection = Connection::getInstance();
$gateway = new SponsorTableGateway($connection);

// Check if user is logged in
if (!is_logged_in()) {
    header("Location: login_form.php");
    exit(); // Add exit() after redirection to stop further execution
}

$user = $_SESSION['user'];

// Handle search query
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';

if (!empty($searchName)) {
    $statement = $gateway->getSponsorByName($searchName);
} else {
    $statement = $gateway->getSponsors();
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
    <div class="content">
        <div class="container">
            <h1>Sponsors</h1>
            <!-- Search form -->
            <form method="GET" action="">
                <div class="form-group">
                    <label for="searchName">Search Sponsor:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName" placeholder="Enter sponsor name">
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
            <div class="row">
            <?php
            $sponsorImages = [
                'Coca Cola' => 'images/coca_cola.jpg',
                'Red Bull' => 'images/red_bull.png',
                'Myntra' => 'images/myn.jpg',
                // Add more mappings as needed
            ];
            $i = 0;
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $i++;
                $modalId = 'sponsorModal' . $i;
                $img = 'images/default.png';
                if (!empty($row['Image'])) {
                    $img = 'images/sponsors/' . $row['Image'];
                }
                echo '<div class="col-md-4">';
                echo '  <div class="card" style="margin-bottom:30px;box-shadow:0 2px 8px #ccc;padding:20px;">';
                echo '    <img src="' . $img . '" class="img-responsive" style="max-height:150px;margin:auto;">';
                echo '    <h2 style="margin-top:15px;">' . htmlspecialchars($row['Name']) . '</h2>';
                echo '    <p><b>Manager:</b> ' . htmlspecialchars($row['ManagerFName']) . ' ' . htmlspecialchars($row['ManagerLName']) . '</p>';
                echo '    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#' . $modalId . '">More Details</button>';
                echo '  </div>';
                echo '</div>';
                // Modal
                echo '<div class="modal fade" id="' . $modalId . '" tabindex="-1" role="dialog" aria-labelledby="' . $modalId . 'Label">';
                echo '  <div class="modal-dialog" role="document">';
                echo '    <div class="modal-content">';
                echo '      <div class="modal-header">';
                echo '        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                echo '        <h4 class="modal-title" id="' . $modalId . 'Label">' . htmlspecialchars($row['Name']) . '</h4>';
                echo '      </div>';
                echo '      <div class="modal-body">';
                echo '        <img src="' . $img . '" class="img-responsive" style="max-height:120px;margin-bottom:10px;">';
                echo '        <p><b>Address:</b> ' . htmlspecialchars($row['Address']) . '</p>';
                echo '        <p><b>Manager:</b> ' . htmlspecialchars($row['ManagerFName']) . ' ' . htmlspecialchars($row['ManagerLName']) . '</p>';
                echo '        <p><b>Email:</b> ' . htmlspecialchars($row['ManagerEmail']) . '</p>';
                echo '        <p><b>Phone:</b> ' . htmlspecialchars($row['PhoneNumber']) . '</p>';
                echo '      </div>';
                echo '      <div class="modal-footer">';
                echo '        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
                echo '      </div>';
                echo '    </div>';
                echo '  </div>';
                echo '</div>';
            }
            ?>
            </div>
            <a class="btn btn-default" href="createSponsorForm.php">Add Sponsor</a>
        </div>
        <div class="container">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <?php require 'utils/footer.php'; ?>
    </div>
    <?php require 'utils/scripts.php'; ?>
</body>
</html>
<?php ob_end_flush(); ?>

