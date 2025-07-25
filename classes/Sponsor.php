<?php
class Sponsor {
    private $id;
    private $name;
    private $address;
    private $managerFName;
    private $managerLName;
    private $managerEmail;
    private $phoneNumber;
    private $image;

    public function __construct($id, $name, $address, $managerFName, $managerLName, $managerEmail, $phoneNumber, $image = null) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->managerFName = $managerFName;
        $this->managerLName = $managerLName;
        $this->managerEmail = $managerEmail;
        $this->phoneNumber = $phoneNumber;
        $this->image = $image;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getAddress() { return $this->address; }
    public function getManagerFName() { return $this->managerFName; }
    public function getManagerLName() { return $this->managerLName; }
    public function getManagerEmail() { return $this->managerEmail; }
    public function getPhoneNumber() { return $this->phoneNumber; }
    public function getImage() { return $this->image; }

    public function setId($id) { $this->id = $id; }
    public function setName($name) { $this->name = $name; }
    public function setAddress($address) { $this->address = $address; }
    public function setManagerFName($managerFName) { $this->managerFName = $managerFName; }
    public function setManagerLName($managerLName) { $this->managerLName = $managerLName; }
    public function setManagerEmail($managerEmail) { $this->managerEmail = $managerEmail; }
    public function setPhoneNumber($phoneNumber) { $this->phoneNumber = $phoneNumber; }
    public function setImage($image) { $this->image = $image; }
}
?> 