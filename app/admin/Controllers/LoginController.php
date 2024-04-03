<?php

namespace App\admin\Controllers;

require_once __DIR__ . '/../core/SessionHandler.php';

class LoginController extends Controller
{
    // Affiche le formulaire de connexion
    public function index()
    {
        $this->render('administrator/login', [], false);
    }

    // Traite la tentative de connexion
    public function login()
    {
        require_once __DIR__ . '/../Core/DbConnect.php';
        $dbConnect = \App\admin\Core\DbConnect::getInstance()->getConnection();

        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;

        $stmt = $dbConnect->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user->password)) {
            // Si les identifiants sont corrects, initialiser la session
            $_SESSION['user'] = $user->id;
            header("Location: index.php?controller=home&action=index");
            exit;
        } else {
            // En cas d'erreur
            header("Location: index.php?controller=login&action=index&error=login");
            exit;
        }
    }

    // Gère la déconnexion de l'utilisateur
    public function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php?controller=login&action=index");
    }
}
