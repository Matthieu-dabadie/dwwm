<?php

namespace App\admin\Controllers;

use App\admin\Models\FooterLinksModel;

class FooterLinksController extends Controller
{
    private $footerLinksModel;

    public function __construct()
    {
        $this->footerLinksModel = new FooterLinksModel();
    }

    public function edit()
    {
        $links = $this->footerLinksModel->getAllLinks();
        $this->render('custom/footerLinks', ['links' => $links]);
    }


    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['links'])) {
            $this->footerLinksModel->saveLinks($_POST['links']);
            $_SESSION['success_message'] = "Les liens ont été sauvegardés avec succès.";
            header('Location: index.php?controller=footerLinks&action=edit');
            exit();
        } else {

            $_SESSION['error_message'] = "Erreur lors de la sauvegarde des liens.";
            header('Location: index.php?controller=footerLinks&action=edit');
            exit();
        }
    }
}
