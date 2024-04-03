<?php

namespace App\public\Controllers;

use App\public\Models\DynamicPageModel;

class DynamicPageController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new DynamicPageModel();
    }

    public function view($params)
    {
        $id = $params['id'] ?? null;
        if (!$id) {
            header('Location: index.php?controller=error&action=pageNotFound');
            exit;
        }

        $pageData = $this->model->getPageById($id);

        if (!$pageData) {
            header('Location: index.php?controller=error&action=pageNotFound');
            exit();
        }

        $this->render('pages/viewPage', ['pageData' => $pageData]);
    }
}
