<?php

namespace App\public\Models;

use App\admin\Core\DbConnect;

class BannerModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getBannerImagePath()
    {
        $sql = "SELECT image_path FROM banner ORDER BY id DESC LIMIT 1";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch();

        if ($result) {
            return $result->image_path;
        } else {
            return '';
        }
    }
}
