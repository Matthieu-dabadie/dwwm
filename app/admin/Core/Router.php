<?php

namespace App\admin\Core;

class Router
{
    public function routes()
    {
        $controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'HomeController';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        $controllerClassName = '\\App\\admin\\Controllers\\' . $controllerName;

        if (class_exists($controllerClassName)) {
            $controllerInstance = new $controllerClassName();
            if (method_exists($controllerInstance, $action)) {
                $params = $_GET;
                unset($params['controller'], $params['action']);
                call_user_func_array([$controllerInstance, $action], [$params]);

                //call_user_func_array([$controllerInstance, $action], $params);
            } else {
                http_response_code(404);
                echo "L'action demandée n'existe pas.";
            }
        } else {
            http_response_code(404);
            echo "Le contrôleur demandé n'existe pas.";
        }
    }
}
