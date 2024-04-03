<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class NewsModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function addNews($title, $content, $rgbaBackgroundColor, $frameColor)
    {
        $sql = "INSERT INTO news (title, content, background_color, frame_color) VALUES (:title, :content, :background_color, :frame_color)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':background_color' => $rgbaBackgroundColor,
            ':frame_color' => $frameColor
        ]);
    }

    public function deleteNews($newsId)
    {
        $sql = "DELETE FROM news WHERE id = :newsId";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':newsId' => $newsId]);
    }



    public function getAllNews()
    {
        $sql = "SELECT * FROM news ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
