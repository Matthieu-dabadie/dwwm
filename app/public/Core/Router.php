<?php

namespace App\public\Core;

class Router
{
    public function routes()
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $controllerName = isset($_GET['controller']) ? ucfirst(strtolower($_GET['controller'])) : 'Home';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        // Log pour voir le contrôleur et l'action demandés
        error_log("Requested controller: $controllerName, action: $action");

        if ($controllerName == 'DynamicPage') {
            $controllerClassName = '\\App\\public\\Controllers\\DynamicPageController';
        } else {
            $controllerClassName = '\\App\\public\\Controllers\\' . $controllerName . 'Controller';
        }

        if (class_exists($controllerClassName)) {
            $controllerInstance = new $controllerClassName();

            if (method_exists($controllerInstance, $action)) {
                $params = $_GET;
                unset($params['controller'], $params['action']);
                call_user_func_array([$controllerInstance, $action], [$params]);
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound()
    {
        http_response_code(404);
        echo "La page recherchée n'existe pas.";
    }
}
