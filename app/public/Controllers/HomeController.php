<?php

namespace App\public\Controllers;

use App\public\Models\HomeModel;
use App\public\Models\BannerModel;

class HomeController extends Controller
{
    public function index()
    {
        $homeModel = new HomeModel();
        $homeContent = $homeModel->getHomeContent();

        $bannerModel = new BannerModel();
        $bannerImagePath = $bannerModel->getBannerImagePath();

        $this->render('home/index', [
            'homeContent' => $homeContent,
            'bannerImagePath' => $bannerImagePath
        ]);
    }
}
