<?php

namespace App\public\Controllers;

use App\admin\Models\NavModel;

class PagesStaticController extends Controller
{
    public function conditions()
    {
        $this->render('pages/conditions');
    }

    public function mentions()
    {
        $this->render('pages/mentions');
    }

    public function faq()
    {
        $this->render('pages/faq');
    }

    public function plansite()
    {

        $navModel = new NavModel();
        $navLinks = $navModel->getNavLinks();

        $this->render('pages/planSite', ['navLinks' => $navLinks]);
    }
}
