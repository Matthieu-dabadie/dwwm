<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;

class BannerModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function saveBannerImagePath($imagePath)
    {
        $sql = "INSERT INTO banner (image_path) VALUES (:image_path)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->execute();

        return $this->db->lastInsertId();
    }
}
