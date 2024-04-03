<?php

namespace App\admin\Controllers;

use App\admin\Models\ContentModel;

class ContentController extends Controller
{
    private $contentModel;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
    }

    public function createArticle()
    {
        $articles = $this->contentModel->getAllArticles();
        $this->render('custom/createArticle', ['articles' => $articles]);
    }

    public function storeArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $backgroundColor = $_POST['backgroundColor'];
            $transparency = $_POST['transparency'];
            $frameColor = $_POST['frameColor'];

            $imagePath = $this->handleImageUpload($_FILES['image']);

            $rgbaBackgroundColor = $this->hexToRgba($backgroundColor, $transparency);

            $result = $this->contentModel->saveArticle($title, $content, $imagePath, $rgbaBackgroundColor, $frameColor);
            if ($result) {
                $_SESSION['article_add_success'] = "L'article a été ajouté avec succès.";
            } else {
                $_SESSION['article_add_error'] = "Erreur lors de l'ajout de l'article.";
            }

            header('Location: index.php?controller=home&action=index');
            exit();
        }
    }


    private function handleImageUpload($file)
    {
        $targetDir = __DIR__ . '/../../public/assets/images/articles/';
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = uniqid("article_") . '.' . strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return 'assets/images/articles/' . $fileName;
        }

        return '';
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

    public function deleteArticle()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $articleId = $_POST['articleId'];
            $result = $this->contentModel->deleteArticle($articleId);
            if ($result) {
                $_SESSION['article_delete_success'] = "L'article a été supprimé avec succès.";
            } else {
                $_SESSION['article_delete_error'] = "Erreur lors de la suppression de l'article.";
            }
            header('Location: index.php?controller=content&action=createArticle');
            exit();
        }
    }
}
