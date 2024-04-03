<?php

namespace App\public\Controllers;

use App\admin\Models\NewsModel;
use App\admin\Models\PageModel;

class PP2Controller extends Controller
{
    private $pageModel;
    private $newsModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
        $this->newsModel = new NewsModel();
    }

    public function index()
    {
        $pageData = $this->pageModel->getPageById(2);
        $newsData = $this->newsModel->getAllNews();
        $this->render('pages/pp2', ['pageData' => $pageData, 'newsData' => $newsData]);
    }
}
