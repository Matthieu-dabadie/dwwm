<?php

namespace App\public\Controllers;

use App\admin\Models\MediaModel;
use App\admin\Models\PageModel;

class PP3Controller extends Controller
{
    private $pageModel;
    private $mediaModel;

    public function __construct()
    {
        $this->pageModel = new PageModel();
        $this->mediaModel = new MediaModel();
    }

    public function index()
    {
        $pageData = $this->pageModel->getPageById(3);
        $albums = $this->mediaModel->getAlbumsWithMedia();
        $this->render('pages/pp3', ['pageData' => $pageData, 'albums' => $albums]);
    }
}
