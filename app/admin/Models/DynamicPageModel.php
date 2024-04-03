<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class DynamicPageModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getAllPages()
    {
        $stmt = $this->db->query("SELECT id, name FROM page_management WHERE is_protected = 0 ORDER BY display_order ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPageById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM page_management WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePageContent($id, $content)
    {
        // Met à jour le contenu d'une page spécifique par son ID
        $sql = "UPDATE page_management SET content = :content WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':content' => $content, ':id' => $id]);
    }
}
