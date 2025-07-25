<?php
require_once 'Sponsor.php';

class SponsorTableGateway {
    private $connect;

    public function __construct($c) {
        $this->connect = $c;
    }

    public function getSponsors() {
        $sqlQuery = "SELECT * FROM sponsors";
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        if (!$status) {
            die("Could not retrieve sponsor details");
        }
        return $statement;
    }

    public function getSponsorById($id) {
        $sqlQuery = "SELECT * FROM sponsors WHERE SponsorID = :id";
        $statement = $this->connect->prepare($sqlQuery);
        $params = array("id" => $id);
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not retrieve sponsor by ID");
        }
        return $statement;
    }

    public function getSponsorByName($name) {
        $sqlQuery = "SELECT * FROM sponsors WHERE Name LIKE :name";
        $statement = $this->connect->prepare($sqlQuery);
        $params = array("name" => "%$name%");
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not retrieve sponsor by name");
        }
        return $statement;
    }

    public function insert($sponsor) {
        $sql = "INSERT INTO sponsors(Name, Address, ManagerFName, ManagerLName, ManagerEmail, PhoneNumber, Image) " .
               "VALUES (:Name, :Address, :ManagerFName, :ManagerLName, :ManagerEmail, :PhoneNumber, :Image)";
        $statement = $this->connect->prepare($sql);
        $params = array(
            "Name" => $sponsor->getName(),
            "Address" => $sponsor->getAddress(),
            "ManagerFName" => $sponsor->getManagerFName(),
            "ManagerLName" => $sponsor->getManagerLName(),
            "ManagerEmail" => $sponsor->getManagerEmail(),
            "PhoneNumber" => $sponsor->getPhoneNumber(),
            "Image" => $sponsor->getImage()
        );
        $status = $statement->execute($params);
        if (!$status) {
            $errorInfo = $statement->errorInfo();
            die("Could not insert sponsor: " . $errorInfo[2]);
        }
        $id = $this->connect->lastInsertId();
        return $id;
    }

    public function update($sponsor) {
        $sql = "UPDATE sponsors SET Name = :Name, Address = :Address, ManagerFName = :ManagerFName, ManagerLName = :ManagerLName, ManagerEmail = :ManagerEmail, PhoneNumber = :PhoneNumber WHERE SponsorID = :id";
        $statement = $this->connect->prepare($sql);
        $params = array(
            "Name" => $sponsor->getName(),
            "Address" => $sponsor->getAddress(),
            "ManagerFName" => $sponsor->getManagerFName(),
            "ManagerLName" => $sponsor->getManagerLName(),
            "ManagerEmail" => $sponsor->getManagerEmail(),
            "PhoneNumber" => $sponsor->getPhoneNumber(),
            "id" => $sponsor->getId()
        );
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not update sponsor details");
        }
    }

    public function delete($id) {
        $sql = "DELETE FROM sponsors WHERE SponsorID = :id";
        $statement = $this->connect->prepare($sql);
        $params = array("id" => $id);
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not delete sponsor");
        }
    }
}
?> 