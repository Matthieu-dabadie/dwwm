<?php

namespace App\public\Models;

use App\admin\Core\DbConnect;
use PDO;

class ColorModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getColors()
    {
        $stmt = $this->db->query("SELECT * FROM color_settings LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
