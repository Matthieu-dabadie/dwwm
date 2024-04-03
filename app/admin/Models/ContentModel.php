<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class ContentModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function saveArticle($title, $content, $imagePath, $rgbaBackgroundColor, $frameColor)
    {
        $sql = "INSERT INTO articles (title, content, image_path, background_color, frame_color) VALUES (:title, :content, :image_path, :background_color, :frame_color)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':image_path' => $imagePath,
            ':background_color' => $rgbaBackgroundColor,
            ':frame_color' => $frameColor,
        ]);
    }

    public function deleteArticle($articleId)
    {
        $sql = "DELETE FROM articles WHERE id = :articleId";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':articleId' => $articleId]);
    }


    public function getAllArticles()
    {
        $sql = "SELECT * FROM articles ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
