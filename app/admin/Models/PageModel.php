<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class PageModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getNextDisplayOrder()
    {
        $sql = "SELECT MAX(display_order) as max_order FROM page_management";
        $stmt = $this->db->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['max_order'] + 1 : 5;
    }

    public function addPage($data)
    {
        $slug = $this->generateSlug($data['name']);
        $displayOrder = $this->getNextDisplayOrder();
        $path = 'index.php?controller=dynamicPage&action=view&id=';

        $sql = "INSERT INTO page_management (name, content, slug, display_order, path) VALUES (:name, :content, :slug, :display_order, :path)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':slug', $slug);
        $stmt->bindParam(':display_order', $displayOrder, PDO::PARAM_INT);
        $stmt->bindParam(':path', $path);
        $stmt->execute();

        $lastId = $this->db->lastInsertId();

        // Mise à jour du path avec l'ID réel
        $pathWithId = 'index.php?controller=dynamicPage&action=view&id=' . $lastId;
        $this->updatePagePath($lastId, $pathWithId);

        return $lastId;
    }

    private function generateSlug($name)
    {
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $name);
        $slug = preg_replace('/[^a-z0-9-]/', '-', strtolower($slug));
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        $originalSlug = $slug;
        $counter = 1;
        while ($this->slugExists($slug)) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function getAllPages()
    {
        $sql = "SELECT * FROM page_management WHERE is_protected = 0 ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function slugExists($slug)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM page_management WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetchColumn() > 0;
    }

    public function updatePagePath($id, $path)
    {
        $sql = "UPDATE page_management SET path = :path WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':path', $path);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deletePage($id)
    {
        $sql = "SELECT is_protected FROM page_management WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $isProtected = $stmt->fetch(PDO::FETCH_ASSOC)['is_protected'];

        if ($isProtected) {
            return false;
        } else {
            $sql = "DELETE FROM page_management WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        }
    }

    public function getPageById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM page_management WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
