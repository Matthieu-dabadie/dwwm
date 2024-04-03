<?php

require_once __DIR__ . '/../Autoloader.php';
App\Autoloader::register();

session_start();

use App\admin\Core\Router;

$route = new Router();
$route->routes();
