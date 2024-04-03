<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class FooterLinksModel
{
    protected $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getAllLinks()
    {
        $stmt = $this->db->query("SELECT * FROM footer_links ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveLinks($links)
    {
        $this->db->beginTransaction();
        try {
            foreach ($links as $link) {
                if (empty($link['name']) || empty($link['url'])) {
                    if (!empty($link['id'])) {

                        $this->db->prepare("DELETE FROM footer_links WHERE id = ?")
                            ->execute([$link['id']]);
                    }
                    continue;
                }

                $column = $link['column'] ?? 'left';
                if (!empty($link['id'])) {

                    $this->db->prepare("UPDATE footer_links SET name = ?, url = ?, `column` = ? WHERE id = ?")
                        ->execute([$link['name'], $link['url'], $column, $link['id']]);
                } else {

                    $this->db->prepare("INSERT INTO footer_links (name, url, `column`) VALUES (?, ?, ?)")
                        ->execute([$link['name'], $link['url'], $column]);
                }
            }
            $this->db->commit();
        } catch (\PDOException $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
