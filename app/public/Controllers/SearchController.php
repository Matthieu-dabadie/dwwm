<?php

namespace App\public\Controllers;

use App\public\Models\SearchModel;

class SearchController extends Controller
{
    public function index()
    {
        $searchTerm = $_GET['q'] ?? '';

        $colorModel = new \App\public\Models\ColorModel();
        $colors = $colorModel->getColors();

        if (!empty($searchTerm)) {
            $searchModel = new SearchModel();
            $results = $searchModel->search($searchTerm);
        } else {
            $results = [];
        }

        $this->render('search/index', ['results' => $results, 'searchTerm' => $searchTerm, 'colors' => $colors]);
    }
}
