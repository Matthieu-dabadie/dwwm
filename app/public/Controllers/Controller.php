<?php

namespace App\public\Controllers;

use App\public\Models\ColorModel;
use App\public\Models\BannerModel;
use App\admin\Models\NavModel;
use App\admin\Models\BackgroundModel;
use App\admin\Models\FaviconModel;
use App\admin\Models\SocialModel;
use App\admin\Models\FooterLinksModel;

abstract class Controller
{
    protected function token()
    {
        $token = bin2hex(random_bytes(32));
        $_SESSION['token'] = $token;
        return $token;
    }

    public function render(string $path, array $data = [])
    {
        // Instanciez les modèles
        $navModel = new NavModel();
        $colorModel = new ColorModel();
        $bannerModel = new BannerModel();
        $backgroundModel = new BackgroundModel();
        $socialModel = new SocialModel();
        $footerLinksModel = new FooterLinksModel();


        // Récupérez les données
        $navLinks = $navModel->getNavLinks();
        $colors = $colorModel->getColors();
        $bannerPath = $bannerModel->getBannerImagePath();
        $backgroundData = $backgroundModel->getBackgroundImage();
        $socialLinks = $socialModel->getSocialLinks();
        $footerLinks = $footerLinksModel->getAllLinks();


        $faviconModel = new FaviconModel();
        $faviconPath = $faviconModel->getFaviconPath();
        $data['faviconPath'] = $faviconPath;
        $data = array_merge($data, [
            'navLinks' => $navLinks,
            'colors' => $colors,
            'bannerPath' => $bannerPath,
            'backgroundData' => $backgroundData,
            'socialLinks' => $socialLinks,
            'footerLinks' => $footerLinks,
        ]);

        extract($data);

        ob_start();
        include __DIR__ . '/../Views/' . $path . '.php';
        $content = ob_get_clean();
        include __DIR__ . '/../Views/common/template.php';
    }
}
