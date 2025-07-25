<?php
require_once 'Event.php';

class EventTableGateway {

    private $connect;
    
    public function __construct($c) {
        $this->connect = $c;
    }
    
    public function getEvents() {
        $sqlQuery = "SELECT e.*, l.name, e.event_type FROM events e LEFT JOIN locations l ON e.locationID = l.locationID";
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute();
        if (!$status) {
            die("Could not retrieve event details");
        }
        return $statement;
    }
    
    public function getEventsByLocationId($id) {
        // execute a query to get all events
        $sqlQuery = "SELECT e.*, l.name " .
                    "FROM events e " .
                    "LEFT JOIN locations l ON e.locationID = l.locationID " .
                    "WHERE e.locationID=:locationId";
        
        $params = array(
            "locationId" => $id
        );
        $statement = $this->connect->prepare($sqlQuery);
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve event details");
        }
        
        return $statement;
    }
    
    public function getEventsById($id) {
        // execute a query to get an event with the specified id
        $sqlQuery = "SELECT * FROM events WHERE eventID = :id";
        
        $statement = $this->connect->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not retrieve Event ID");
        }
        
        return $statement;
    }
    
    public function getEventsByOrganizerId($organizerId) {
        $sqlQuery = "SELECT e.*, l.name FROM events e LEFT JOIN locations l ON e.locationID = l.locationID WHERE e.organizer_id = :organizerId";
        $statement = $this->connect->prepare($sqlQuery);
        $params = array("organizerId" => $organizerId);
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not retrieve organizer's events");
        }
        return $statement;
    }
    
    public function getEventsByType($type) {
        $sqlQuery = "SELECT e.*, l.name, e.event_type FROM events e LEFT JOIN locations l ON e.locationID = l.locationID WHERE e.event_type = :type";
        $statement = $this->connect->prepare($sqlQuery);
        $statement->execute(['type' => $type]);
        return $statement;
    }
    
    public function insert($p) {
        $sql = "INSERT INTO events(Title, Description, StartDate, EndDate, Cost, LocationID, organizer_id, event_type) " .
                "VALUES (:Title, :Description, :StartDate, :EndDate, :Cost, :LocationID, :organizer_id, :event_type)";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "Title"           => $p->getTitle(),
            "Description"     => $p->getDescription(),            
            "StartDate"       => $p->getStartDate(),
            "EndDate"         => $p->getEndDate(),
            "Cost"            => $p->getCost(),
            "LocationID"      => $p->getLocationID(),
            "organizer_id"    => $p->getOrganizerId(),
            "event_type"      => $p->getEventType()
        );
        
        echo "<pre>";
        print_r($p);
        print_r($params);
        echo "</pre>";
        
        $status = $statement->execute($params);
        
        
        if (!$status) {
            die("Could not insert event");
        }
        
        $id = $this->connect->lastInsertId();
        
        return $id;
    }

    public function update($p) {
        $sql = "UPDATE events SET " .
                "Title = :Title, " . 
                "Description = :Description, " .                
                "StartDate = :StartDate, " .
                "EndDate = :EndDate, " .
                "Cost = :Cost, " .
                "LocationID = :LocationID, " .
                " WHERE eventID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "Title"          => $p->getTitle(),
            "Description"    => $p->getDescription(),            
            "StartDate"      => $p->getStartDate(),
            "EndDate"        => $p->getEndDate(),
            "Cost"           => $p->getCost(),
            "LocationID"     => $p->getLocationID(),
            "id"             => $p->getId()
        );
        
        echo "<pre>";
        print_r($p);
        print_r($params);
        print_r($statement);
        echo "</pre>";
        
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not update event details");
        }
    }
    
    public function delete($id) {
        $sql = "DELETE FROM events WHERE eventID = :id";
        
        $statement = $this->connect->prepare($sql);
        $params = array(
            "id" => $id
        );
        $status = $statement->execute($params);
        
        if (!$status) {
            die("Could not delete event");
        }
    }    

    
}