<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class BackgroundModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getBackgroundImage()
    {
        $sql = "SELECT * FROM background_settings ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateBackground($imageName, $containerType)
    {
        $sql = "INSERT INTO background_settings (id, image_path, container_type) VALUES (1, :image_path, :container_type)
                ON DUPLICATE KEY UPDATE image_path = :image_path, container_type = :container_type";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':image_path' => $imageName,
            ':container_type' => $containerType
        ]);
    }

    public function clearBackground()
    {
        $this->updateBackground('no-image.jpeg', '');
    }
}
