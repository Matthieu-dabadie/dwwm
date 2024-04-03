<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class FaviconModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function saveFaviconPath($imagePath)
    {
        $sql = "INSERT INTO favicon_settings (id, image_path) VALUES (1, :image_path) ON DUPLICATE KEY UPDATE image_path = :image_path";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':image_path', $imagePath, PDO::PARAM_STR);
        return $stmt->execute();
    }


    public function getLatestFavicon()
    {
        // Cette fonction récupère le dernier favicon téléchargé
        $sql = "SELECT image_path FROM favicon_settings ORDER BY uploaded_at DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['image_path'] ?? null;
    }

    public function getFaviconPath()
    {
        $sql = "SELECT image_path FROM favicon_settings ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {

            return '/app/public/assets/images/favicon/' . $result['image_path'];
        } else {
            return null;
        }
    }
}
