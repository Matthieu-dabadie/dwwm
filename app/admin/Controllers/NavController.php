<?php

namespace App\admin\Controllers;

use App\admin\Models\NavModel;

class NavController extends Controller
{
    private $navModel;

    public function __construct()
    {
        $this->navModel = new NavModel();
    }

    public function editNav()
    {
        $links = $this->navModel->getNavLinks();
        $this->render('custom/editNav', ['links' => $links]);
    }

    public function adjustOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $names = $_POST['names'] ?? [];
            $ids = array_keys($names);

            $this->navModel->updateNavLinks($names, $ids);

            $_SESSION['nav_update_success'] = 'La navigation a été mise à jour avec succès.';
            header('Location: index.php?controller=home&action=index');
            exit();
        }
    }
}
