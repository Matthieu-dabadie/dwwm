<?php

namespace App\public\Controllers;

use App\admin\Models\PageModel;
use App\admin\Models\ContentModel;

class PP1Controller extends Controller
{
    private $pageModel;
    private $contentModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
        $this->contentModel = new ContentModel();
    }

    public function index()
    {
        $pageData = $this->pageModel->getPageById(1);
        $articlesData = $this->contentModel->getAllArticles();

        $this->render('pages/pp1', [
            'pageData' => $pageData,
            'articlesData' => $articlesData
        ]);
    }
}
