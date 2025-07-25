<?php
class Location {
    private $Name;
    private $Address;    
    private $ManagerFName;
    private $ManagerLName;
    private $ManagerEmail;
    private $ManagerNumber;
    private $MaxCapacity;
    private $organizer_id;
    
    public function __construct($id, $name, $address, $manFName, $manLName, $manEmail, $manNumber, $maxCap, $organizer_id = null) {
        $this->id = $id;
        $this->Name = $name;
        $this->Address = $address;
        $this->ManagerFName = $manFName;
        $this->ManagerLName = $manLName;
        $this->ManagerEmail = $manEmail;
        $this->ManagerNumber = $manNumber;
        $this->MaxCapacity = $maxCap;
        $this->organizer_id = $organizer_id;
    }
    
    public function getId() { return $this->id; }
    public function getName() { return $this->Name; }
    public function getAddress() { return $this->Address; }
    public function getMFName() { return $this->ManagerFName; }
    public function getMLName() { return $this->ManagerLName; }
    public function getMEmail() { return $this->ManagerEmail; }
    public function getMNumber() { return $this->ManagerNumber; }
    public function getCap() { return $this->MaxCapacity; }
    public function getOrganizerId() { return $this->organizer_id; }
}
?>