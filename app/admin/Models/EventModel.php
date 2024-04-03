<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class EventModel
{
    private $db;

    public function __construct()
    {

        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function addEvent($name, $eventDate, $eventTime, $description)
    {
        $sql = "INSERT INTO events (name, event_date, event_time, description) VALUES (:name, :event_date, :event_time, :description)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':event_date', $eventDate);
        $stmt->bindParam(':event_time', $eventTime);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
    }

    public function getAllEvents()
    {

        $sql = "SELECT * FROM events ORDER BY event_date DESC, event_time DESC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteEvent($eventId)
    {
        $sql = "DELETE FROM events WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
        $stmt->execute();
    }
}
