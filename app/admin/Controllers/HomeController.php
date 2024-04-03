<?php

namespace App\admin\Controllers;

use App\admin\Models\ColorModel;
use App\admin\Models\HomeModel;

class HomeController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login&action=index");
            exit;
        }

        $this->render('home/index');
    }

    public function showColors()
    {
        $colorModel = new ColorModel();
        $colors = $colorModel->getColors();
        $this->render('custom/color', ['colors' => $colors]);
    }

    public function updateColors()
    {
        $colorModel = new ColorModel();

        $data = [
            ':textColor' => $_POST['text_color'] ?? '#000000',
            ':backgroundColor' => $_POST['background_color'] ?? '#FFFFFF',
            ':primaryNavbarTextColor' => $_POST['primary_navbar_text_color'] ?? '#FFFFFF',
            ':primaryNavbarBackgroundColor' => $_POST['primary_navbar_background_color'] ?? '#333333',
            ':secondaryNavbarTextColor' => $_POST['secondary_navbar_text_color'] ?? '#FFFFFF',
            ':secondaryNavbarBackgroundColor' => $_POST['secondary_navbar_background_color'] ?? '#333333',
            ':footerColor1' => $_POST['footer_color_1'] ?? '#555555',
            ':footerColor2' => $_POST['footer_color_2'] ?? '#777777',
            ':footerTextColor' => $_POST['footer_text_color'] ?? '#FFFFFF',
        ];

        $colorModel->updateColors($data);

        $_SESSION['color_update_success'] = "Les couleurs ont été mises à jour avec succès.";
        header('Location: index.php?controller=home&action=index');
        exit();
    }

    public function editHome()
    {
        $this->checkLogin();

        $homeModel = new HomeModel();
        $homeContent = $homeModel->getHomeContent();

        $this->render('custom/editHome', ['homeContent' => $homeContent['content'] ?? '']);
    }



    public function saveHomeContent()
    {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['homeContent'])) {
            $homeContent = $_POST['homeContent'];

            $homeModel = new HomeModel();
            if ($homeModel->contentExists()) {
                $homeModel->updateHomeContent($homeContent);
            } else {
                $homeModel->saveHomeContent($homeContent);
            }

            $_SESSION['home_update_success'] = "Le contenu de la page d'accueil a été mis à jour avec succès.";
        }

        header('Location: index.php?controller=home&action=index');
        exit();
    }


    private function checkLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=login&action=index");
            exit;
        }
    }
}
