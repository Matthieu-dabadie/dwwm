<?php

namespace App\admin\Controllers;

use App\admin\Models\NewsModel;

class NewsController extends Controller
{
    private $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    public function create()
    {
        $newss = $this->newsModel->getAllNews();
        $this->render('custom/news', ['newss' => $newss]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'], $_POST['backgroundColor'], $_POST['transparency'], $_POST['frameColor'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $backgroundColor = $_POST['backgroundColor'];
            $transparency = $_POST['transparency'];
            $frameColor = $_POST['frameColor'];

            $rgbaBackgroundColor = $this->hexToRgba($backgroundColor, $transparency);
            $result = $this->newsModel->addNews($title, $content, $rgbaBackgroundColor, $frameColor);
            if ($result) {
                $_SESSION['news_add_success'] = "L'actualité a été ajoutée avec succès.";
            } else {
                $_SESSION['news_add_error'] = "Erreur lors de l'ajout de l'actualité.";
            }

            header('Location: index.php?controller=home&action=index');
            exit();
        } else {

            $_SESSION['news_add_error'] = "Tous les champs requis ne sont pas remplis.";
            header('Location: index.php?controller=news&action=create');
            exit();
        }
    }

    private function hexToRgba($hex, $alpha)
    {

        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgba = 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $alpha . ')';
        return $rgba;
    }

    public function deleteNews()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newsId = $_POST['newsId'];
            $result = $this->newsModel->deleteNews($newsId);
            if ($result) {
                $_SESSION['news_delete_success'] = "L'actualité a été supprimée avec succès.";
            } else {
                $_SESSION['news_delete_error'] = "Erreur lors de la suppression de l'actualité.";
            }
            header('Location: index.php?controller=news&action=create');
            exit();
        }
    }
}
