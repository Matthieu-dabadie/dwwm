<?php

namespace App\public\Models;

use App\admin\Core\DbConnect;
use PDO;

class HomeModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getHomeContent()
    {
        $stmt = $this->db->query("SELECT content FROM edit_home ORDER BY id DESC LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
