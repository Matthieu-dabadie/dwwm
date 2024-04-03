<?php

namespace App\admin\Controllers;

use App\admin\Models\DynamicPageModel;

class DynamicPageController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new DynamicPageModel();
    }

    public function edit()
    {

        $pages = $this->model->getAllPages();
        $this->render('custom/editDynamiquePage', ['pages' => $pages]);
    }

    public function editSelectedPage()
    {

        $pageId = $_GET['id'] ?? null;

        if ($pageId) {
            $pageData = $this->model->getPageById($pageId);
            if ($pageData) {
                $this->render('custom/editSelectedPage', ['pageData' => $pageData]);
            } else {

                $_SESSION['page_edit_error'] = "La page demandée n'existe pas.";
                header('Location: index.php?controller=dynamicPage&action=edit');
                exit();
            }
        } else {

            header('Location: index.php?controller=dynamicPage&action=edit');
            exit();
        }
    }

    public function saveEditedPage()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pageId'], $_POST['content'])) {
            $pageId = $_POST['pageId'];
            $content = $_POST['content'];

            $this->model->updatePageContent($pageId, $content);

            $_SESSION['page_edit_success'] = "La page a été mise à jour avec succès.";
            header('Location: index.php?controller=home&action=index');
            exit();
        } else {
            $_SESSION['page_edit_error'] = "Erreur lors de la mise à jour de la page.";
            header('Location: index.php?controller=home&action=index');
            exit();
        }
    }


    public function addPage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['content'])) {

            $name = $_POST['name'];
            $content = $_POST['content'] ?? '';



            $_SESSION['page_add_success'] = "La page a été ajoutée avec succès.";
            header('Location: index.php?controller=dynamicPage&action=edit');
            exit();
        } else {
            $_SESSION['page_add_error'] = "Erreur lors de l'ajout de la page.";
            header('Location: index.php?controller=dynamicPage&action=edit');
            exit();
        }
    }
}
