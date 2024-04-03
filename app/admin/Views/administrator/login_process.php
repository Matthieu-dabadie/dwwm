<?php


require_once '../../Core/DbConnect.php';

use App\admin\Core\DbConnect;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_utilisateur = $_POST['username'];
    $mot_de_passe = $_POST['password'];

    $dbConnect = DbConnect::getInstance()->getConnection();

    $stmt = $dbConnect->prepare("SELECT password FROM admins WHERE username = :username");
    $stmt->execute(['username' => $nom_utilisateur]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($mot_de_passe, $admin->password)) {
        session_start();
        $_SESSION['admin'] = $nom_utilisateur;
        // Modification pour utiliser le routeur
        header("Location: /app/admin?controller=home&action=index");
        exit();
    } else {
        // Assurez-vous que cette redirection est également mise à jour si nécessaire
        header("Location: ../../index.php?error=1");
        exit();
    }
}
