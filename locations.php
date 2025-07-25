<?php
require_once 'classes/Connection.php';
require_once 'classes/LocationTableGateway.php';

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);
$statement = $gateway->getLocations();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Locations</title>
        <?php require 'utils/styles.php'; ?>
        <?php require 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require 'utils/header.php'; ?>
        <div class="content">
            <div class="container">
                <div class="col-md-12">
                    <h1>Locations</h1>
                </div>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <?php
            $defaultImage = 'images/royalhotel.jpg';
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            while ($row) {
                $imageFile = $defaultImage;
                if (!empty($row['image']) && file_exists('images/' . $row['image'])) {
                    $imageFile = 'images/' . $row['image'];
                }
            ?>
            <div class="row">
                <section>
                    <div class="container">
                        <div class="col-md-4">
                            <img src="<?php echo $imageFile; ?>" class="img-responsive" style="height:300px; width:400px;">
                        </div>
                        <div class="subcontent col-md-8">
                            <h1 class="title"><?php echo htmlspecialchars($row['Name']); ?></h1>
                            <p class="location"><?php echo htmlspecialchars($row['Address']); ?></p>
                            <p class="definition">Manager: <?php echo htmlspecialchars($row['ManagerFName'] . ' ' . $row['ManagerLName']); ?><br>Email: <?php echo htmlspecialchars($row['ManagerEmail']); ?><br>Phone: <?php echo htmlspecialchars($row['ManagerNumber']); ?><br>Max Capacity: <?php echo htmlspecialchars($row['MaxCapacity']); ?></p>
                        </div>
                    </div>
                </section>
            </div>
            <div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
            <?php
                $row = $statement->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <?php require 'utils/footer.php'; ?>
        </div>
    </body>
</html> 