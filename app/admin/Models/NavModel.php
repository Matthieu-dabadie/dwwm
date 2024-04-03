<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class NavModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getNavLinks()
    {
        $sql = "SELECT * FROM page_management ORDER BY display_order ASC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateNavLinks($names, $orderedIds)
    {
        foreach ($orderedIds as $displayOrder => $id) {
            if (array_key_exists($id, $names)) {
                $name = $names[$id];
                // Générer le slug à partir du nom
                $slug = $this->generateSlugFromName($name);
                $sql = "UPDATE page_management SET name = :name, slug = :slug, display_order = :displayOrder WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([
                    ':id' => $id,
                    ':name' => $name,
                    ':slug' => $slug,
                    ':displayOrder' => $displayOrder
                ]);
            }
        }
    }

    private function generateSlugFromName($name)
    {
        // Transformer le nom en minuscules
        $slug = mb_strtolower($name, 'UTF-8');

        // Remplacer les espaces par des tirets
        $slug = str_replace(' ', '-', $slug);

        // Supprimer les caractères spéciaux sauf les caractères accentués
        $slug = preg_replace('/[^a-z0-9-éèêëàâäôöûüç]+/u', '', $slug);

        // Supprimer les tirets multiples
        $slug = preg_replace('/-+/', '-', $slug);

        // Supprimer les tirets du début et de la fin
        $slug = trim($slug, '-');
        return $slug;
    }
}
