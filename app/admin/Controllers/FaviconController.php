<?php

namespace App\admin\Controllers;

use App\admin\Models\FaviconModel;
use Exception;

class FaviconController extends Controller
{
    private $faviconModel;

    public function __construct()
    {
        $this->faviconModel = new FaviconModel();
    }

    public function setFavicon()
    {

        $this->render('custom/setFavicon');
    }

    public function saveFavicon()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérifier si un fichier a été téléchargé
            if (!isset($_FILES['favicon']) || $_FILES['favicon']['error'] == UPLOAD_ERR_NO_FILE) {
                $_SESSION['favicon_update_error'] = "Aucun fichier n'a été téléchargé.";
                header('Location: index.php?controller=home&action=index');
                exit();
            }

            $favicon = $_FILES['favicon'];


            if ($favicon['error'] == UPLOAD_ERR_INI_SIZE || $favicon['error'] == UPLOAD_ERR_FORM_SIZE) {
                $_SESSION['favicon_update_error'] = "La taille du fichier est trop grande. La taille maximale autorisée est de 2MB.";
                header('Location: index.php?controller=home&action=index');
                exit();
            }




            $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/app/public/assets/images/favicon/";
            $faviconFileType = strtolower(pathinfo($favicon['name'], PATHINFO_EXTENSION));
            $targetFileName = "favicon." . $faviconFileType;
            $targetFile = $targetDir . $targetFileName;


            if (getimagesize($favicon["tmp_name"]) === false) {
                $_SESSION['favicon_update_error'] = "Le fichier n'est pas une image valide.";
                header('Location: index.php?controller=home&action=index');
                exit();
            }


            $allowedTypes = ['ico', 'png', 'gif', 'jpg', 'jpeg'];
            if (!in_array($faviconFileType, $allowedTypes)) {
                $_SESSION['favicon_update_error'] = "Format de fichier non autorisé. Les formats acceptés sont: ICO, PNG, GIF, JPG, JPEG.";
                header('Location: index.php?controller=home&action=index');
                exit();
            }


            if (move_uploaded_file($favicon["tmp_name"], $targetFile)) {
                try {
                    $this->faviconModel->saveFaviconPath($targetFileName);
                    $_SESSION['favicon_update_success'] = "Le favicon a été mis à jour avec succès.";
                } catch (Exception $e) {
                    $_SESSION['favicon_update_error'] = "Erreur lors de la mise à jour du favicon: " . $e->getMessage();
                }
            } else {
                $_SESSION['favicon_update_error'] = "Erreur lors du téléchargement du fichier.";
            }

            header('Location: index.php?controller=home&action=index');
            exit();
        }
    }
}
