<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class MediaModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function addAlbum($title, $coverMediaPath)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO albums (title, cover_media_path) VALUES (?, ?)");
            $stmt->execute([$title, $coverMediaPath]);
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout de l\'album: ' . $e->getMessage());
            return false;
        }
    }

    public function addMedia($albumId, $filePath)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO media (album_id, file_path) VALUES (?, ?)");
            $stmt->execute([$albumId, $filePath]);
            return $this->db->lastInsertId();
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du média: ' . $e->getMessage());
            return null;
        }
    }

    public function updateAlbum($albumId, $coverMediaPath)
    {
        try {
            $stmt = $this->db->prepare("UPDATE albums SET cover_media_path = ? WHERE id = ?");
            $stmt->execute([$coverMediaPath, $albumId]);
        } catch (\Exception $e) {
            error_log('Erreur lors de la mise à jour de l\'album: ' . $e->getMessage());
        }
    }

    public function getAlbumsWithMedia()
    {
        $albums = [];
        try {
            $stmt = $this->db->query("SELECT a.id, a.title, a.cover_media_path, m.file_path FROM albums a LEFT JOIN media m ON a.id = m.album_id ORDER BY a.id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $albums[$row['id']]['title'] = $row['title'];
                $albums[$row['id']]['cover_media_path'] = $row['cover_media_path'];
                $albums[$row['id']]['media'][] = $row['file_path'];
            }
            return $albums;
        } catch (\Exception $e) {
            error_log('Erreur lors de la récupération des albums: ' . $e->getMessage());
            return [];
        }
    }


    public function getAllAlbums()
    {
        try {
            $stmt = $this->db->query("SELECT id, title FROM albums ORDER BY title ASC");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log('Erreur lors de la récupération des albums: ' . $e->getMessage());
            return [];
        }
    }


    public function deleteAlbumAndMedia($albumId)
    {
        try {
            // Supprimer les médias de l'album
            $stmt = $this->db->prepare("DELETE FROM media WHERE album_id = ?");
            $stmt->execute([$albumId]);

            // Supprimer l'album
            $stmt = $this->db->prepare("DELETE FROM albums WHERE id = ?");
            $stmt->execute([$albumId]);

            return true;
        } catch (\Exception $e) {
            error_log('Erreur lors de la suppression de l\'album et des médias: ' . $e->getMessage());
            return false;
        }
    }
}
