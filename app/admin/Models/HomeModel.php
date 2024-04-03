<?php

namespace App\admin\Models;

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

    public function saveHomeContent($content)
    {

        $check = $this->db->query("SELECT id FROM edit_home LIMIT 1");
        $exists = $check->fetch(PDO::FETCH_ASSOC);

        if ($exists) {

            $stmt = $this->db->prepare("UPDATE edit_home SET content = :content WHERE id = :id");
            return $stmt->execute([':content' => $content, ':id' => $exists['id']]);
        } else {

            $stmt = $this->db->prepare("INSERT INTO edit_home (content) VALUES (:content)");
            return $stmt->execute([':content' => $content]);
        }
    }


    public function contentExists()
    {
        $stmt = $this->db->query("SELECT COUNT(*) FROM edit_home");
        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    public function updateHomeContent($content)
    {

        $stmt = $this->db->query("SELECT id FROM edit_home ORDER BY id DESC LIMIT 1");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $id = $row['id'];


            $updateStmt = $this->db->prepare("UPDATE edit_home SET content = :content WHERE id = :id");
            $updateStmt->execute([':content' => $content, ':id' => $id]);
        } else {

            $insertStmt = $this->db->prepare("INSERT INTO edit_home (content) VALUES (:content)");
            $insertStmt->execute([':content' => $content]);
        }
    }
}
