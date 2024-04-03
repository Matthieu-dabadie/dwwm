<?php

namespace App\public\Controllers;

use App\admin\Models\PageModel;

class PP4Controller extends Controller
{
    private $pageModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
    }

    public function index()
    {
        $pageData = $this->pageModel->getPageById(4);
        $this->render('pages/pp4', ['pageData' => $pageData]);
    }
}
