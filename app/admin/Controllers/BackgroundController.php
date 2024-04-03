<?php

namespace App\admin\Controllers;

use App\admin\Models\BackgroundModel;
use Exception;

class BackgroundController extends Controller
{
    private $backgroundModel;

    public function __construct()
    {
        $this->backgroundModel = new BackgroundModel();
    }

    public function setBackground()
    {
        $backgroundData = $this->backgroundModel->getBackgroundImage();
        $this->render('custom/setBackground', ['backgroundData' => $backgroundData]);
    }

    public function saveBackground()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $containerType = $_POST['containerType'] ?? 'container';
                $imageName = "no-image.jpeg";

                if (!empty($_FILES['backgroundImage']['name'])) {
                    $image = $_FILES['backgroundImage'];
                    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/app/public/assets/images/background/";
                    $imageFileType = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
                    $targetFileName = uniqid("bg_") . '.' . $imageFileType;
                    $targetFile = $targetDir . $targetFileName;

                    if (!move_uploaded_file($image["tmp_name"], $targetFile)) {
                        throw new Exception("Failed to upload image.");
                    }
                    $imageName = $targetFileName;
                } elseif (isset($_POST['noBackground'])) {
                    $this->backgroundModel->clearBackground();
                    $_SESSION['background_update_success'] = "L’arrière-plan a été effacé avec succès.";
                    header('Location: index.php?controller=home&action=index');
                    return;
                }

                $this->backgroundModel->updateBackground($imageName, $containerType);
                $_SESSION['background_update_success'] = "
                Arrière-plan mis à jour avec succès.";
            }
        } catch (Exception $e) {
            $_SESSION['background_update_error'] = "Une erreur s'est produite : " . $e->getMessage();
        }
        header('Location: index.php?controller=home&action=index');
    }
}
