<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class ArticleModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function addArticle($title, $content, $imagePath)
    {
        $sql = "INSERT INTO articles (title, content, image_path) VALUES (:title, :content, :imagePath)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':title' => $title, ':content' => $content, ':imagePath' => $imagePath]);
        return $this->db->lastInsertId();
    }
}
