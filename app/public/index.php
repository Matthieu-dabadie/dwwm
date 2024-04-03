<?php
// Activer l'affichage des erreurs PHP
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Démarrer la session
session_start();

// Inclure l'autoloader
require_once __DIR__ . '/../Autoloader.php';

// Enregistrer l'autoloader
App\Autoloader::register();

// Utiliser les espaces de noms
use App\Public\Core\Router;

// Créer une instance du routeur
$route = new Router();

// Appeler la méthode routes
$route->routes();
