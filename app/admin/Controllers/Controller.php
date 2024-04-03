<?php

namespace App\admin\Controllers;

require_once __DIR__ . '/../core/SessionHandler.php';

abstract class Controller
{
    public function render(string $path, array $data = [], $useTemplate = true)
    {
        extract($data);
        ob_start();

        $viewPath = __DIR__ . '/../Views/' . $path . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "Le fichier de vue n'existe pas: " . $viewPath;
        }

        $content = ob_get_clean();

        if ($useTemplate) {
            include __DIR__ . '/../Views/common/template.php';
        } else {
            echo $content;
        }
    }
}
