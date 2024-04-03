<?php

namespace App\public\Models;

use App\admin\Core\DbConnect;
use PDO;

class DynamicPageModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getPageById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM page_management WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }
}
