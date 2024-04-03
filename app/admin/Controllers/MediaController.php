<?php

namespace App\admin\Controllers;

use App\admin\Models\MediaModel;

class MediaController extends Controller
{
    private $mediaModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
    }

    public function create()
    {
        $albums = $this->mediaModel->getAllAlbums();
        $this->render('custom/createMedia', ['albums' => $albums]);
    }

    public function processUpload()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['media'])) {
            $albumTitle = $_POST['albumTitle'] ?? 'Album sans titre';
            $_SESSION['uploaded_media_paths'] = [];
            $_SESSION['albumTitle'] = $albumTitle;

            foreach ($_FILES['media']['tmp_name'] as $key => $tmpName) {
                $fileName = basename($_FILES['media']['name'][$key]);
                $temporaryPath = __DIR__ . '/../../public/uploads/temp/' . $fileName;
                if (!is_dir(dirname($temporaryPath))) {
                    mkdir(dirname($temporaryPath), 0777, true);
                }
                if (move_uploaded_file($tmpName, $temporaryPath)) {
                    $_SESSION['uploaded_media_paths'][] = 'uploads/temp/' . $fileName;
                }
            }
            header('Location: index.php?controller=media&action=selectCoverMedia');
            exit;
        }
    }

    public function selectCoverMedia()
    {
        $this->render('custom/selectCoverMedia', ['temporaryPaths' => $_SESSION['uploaded_media_paths'] ?? []]);
    }

    public function saveAlbum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cover'], $_SESSION['uploaded_media_paths'], $_SESSION['albumTitle'])) {
            $albumTitle = $_SESSION['albumTitle'];
            $coverPath = $_POST['cover'];

            // Premièrement, créer l'album sans spécifier la couverture
            $albumId = $this->mediaModel->addAlbum($albumTitle, null);

            if (!$albumId) {
                $_SESSION['media_add_error'] = "Erreur lors de la création de l'album.";
                header('Location: index.php?controller=media&action=create');
                exit;
            }

            $finalMediaPaths = [];
            foreach ($_SESSION['uploaded_media_paths'] as $tempPath) {
                $fileName = basename($tempPath);
                $finalPath = __DIR__ . '/../../public/assets/media/' . $albumId . '/' . $fileName;
                if (!is_dir(dirname($finalPath))) {
                    mkdir(dirname($finalPath), 0777, true);
                }
                if (rename(__DIR__ . '/../../public/' . $tempPath, $finalPath)) {
                    $mediaPath = 'assets/media/' . $albumId . '/' . $fileName;
                    $this->mediaModel->addMedia($albumId, $mediaPath);
                    $finalMediaPaths[$tempPath] = $mediaPath;
                }
            }

            // Identifier et enregistrer le chemin de la couverture
            $coverMediaPath = $finalMediaPaths[$coverPath] ?? '';
            if ($coverMediaPath) {
                $this->mediaModel->updateAlbum($albumId, $coverMediaPath);
            }

            $_SESSION['media_add_success'] = "L'album a été créé avec succès.";
            unset($_SESSION['uploaded_media_paths'], $_SESSION['albumTitle']);
            header('Location: index.php?controller=home&action=index');
            exit;
        }
    }


    public function deleteAlbum()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['albumId'])) {
            $albumId = $_POST['albumId'];

            // Supprimer les médias et l'album
            if ($this->mediaModel->deleteAlbumAndMedia($albumId)) {
                // Supprimer le dossier de l'album
                $albumPath = __DIR__ . '/../../public/assets/media/' . $albumId;
                if (is_dir($albumPath)) {
                    array_map('unlink', glob("$albumPath/*.*"));
                    rmdir($albumPath);
                }

                $_SESSION['media_delete_success'] = "L'album et ses médias ont été supprimés avec succès.";
            } else {
                $_SESSION['media_delete_error'] = "Erreur lors de la suppression de l'album.";
            }
            header('Location: index.php?controller=media&action=create');
            exit;
        }
    }
}
