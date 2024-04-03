<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class SocialModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getSocialLinks()
    {
        $stmt = $this->db->query("SELECT platform, url FROM social_links");
        $links = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $links[$row['platform']] = $row['url'];
        }
        return $links;
    }

    public function saveLinks($data)
    {
        $success = true;
        foreach ($data as $platform => $url) {
            if (in_array($platform, ['facebook', 'instagram', 'twitter'])) {
                $this->upsertLink($platform, $url);
            }
            return $success;
        }
    }

    private function upsertLink($platform, $url)
    {
        // Check if the link already exists
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM social_links WHERE platform = :platform");
        $stmt->execute([':platform' => $platform]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            // Update
            $sql = "UPDATE social_links SET url = :url WHERE platform = :platform";
        } else {
            // Insert
            $sql = "INSERT INTO social_links (platform, url) VALUES (:platform, :url)";
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':platform' => $platform, ':url' => $url]);
    }
}
