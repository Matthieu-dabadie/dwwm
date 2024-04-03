<?php

namespace App\public\Models;

use App\admin\Core\DbConnect;
use PDO;

class SearchModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function search($term)
    {
        $stmt = $this->db->prepare("SELECT * FROM articles WHERE title LIKE :term");
        $stmt->execute([':term' => '%' . $term . '%']);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
