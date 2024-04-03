<?php

namespace App\admin\Controllers;

use App\admin\Models\PageModel;
use PDOException;

class PageController extends Controller
{
    private $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function addPage()
    {
        $pages = $this->pageModel->getAllPages();
        $this->render('custom/addPage', ['pages' => $pages]);
    }

    public function storePage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
            $name = $_POST['name'];
            $content = $_POST['content'] ?? '';

            try {

                $this->pageModel->addPage([
                    'name' => $name,
                    'content' => $content

                ]);

                $_SESSION['page_add_success'] = "La page '$name' a été ajoutée avec succès.";
            } catch (\Exception $e) {
                $_SESSION['page_add_error'] = "Erreur lors de l'ajout de la page: " . $e->getMessage();
            }

            header('Location: index.php?controller=home&action=index');
            exit();
        }

        $_SESSION['page_add_error'] = "Le nom de la page est obligatoire.";
        header('Location: index.php?controller=home&action=index');
        exit();
    }

    public function deletePage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['pageId'])) {
            $pageId = $_POST['pageId'];

            try {
                $pageDeleted = $this->pageModel->deletePage($pageId);
                if ($pageDeleted) {
                    $_SESSION['page_delete_success'] = "La page a été supprimée avec succès.";
                } else {
                    $_SESSION['page_delete_error'] = "La page ne peut pas être supprimée ou n'existe pas.";
                }
            } catch (PDOException $e) {
                $_SESSION['page_delete_error'] = "Erreur lors de la suppression de la page: " . $e->getMessage();
            }

            header('Location: index.php?controller=page&action=addPage');
            exit();
        }
    }
}
