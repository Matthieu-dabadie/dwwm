<?php

namespace App\admin\Controllers;

use App\admin\Models\SocialModel;

class SocialController extends Controller
{
    private $socialModel;

    public function __construct()
    {
        $this->socialModel = new SocialModel();
    }

    public function edit()
    {
        $socialLinks = $this->socialModel->getSocialLinks();
        $this->render('custom/editSocial', ['socialLinks' => $socialLinks]);
    }

    public function saveLinks()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $linksData = [
                'facebook' => $_POST['facebook'] ?? '',
                'instagram' => $_POST['instagram'] ?? '',
                'twitter' => $_POST['twitter'] ?? '',
            ];


            $result = $this->socialModel->saveLinks($linksData);

            if ($result) {
                $_SESSION['social_links_update_success'] = "Les liens des réseaux sociaux ont été mis à jour avec succès.";
            } else {
                $_SESSION['social_links_update_error'] = "Erreur lors de la mise à jour des liens.";
            }

            header('Location: index.php?controller=home&action=index');
            exit();
        }
    }
}
