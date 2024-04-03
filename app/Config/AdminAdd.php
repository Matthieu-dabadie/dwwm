<?php

require_once 'DbConnect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Connexion à la base de données
        $dbConnect = new \App\Core\DbConnect();
        $connection = $dbConnect->getConnection();

        // Préparation de la requête d'insertion
        $stmt = $connection->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");

        // Exécution de la requête avec les paramètres
        $success = $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

        if ($success) {
            // Redirection vers app/public/index.php après un délai de 3 secondes
            echo "<script>alert('Création réalisée avec succès !'); setTimeout(function(){ window.location.href = '../public/index.php'; }, 1000);</script>";
            exit();
        } else {
            // Affichage d'un message d'erreur si l'insertion a échoué
            echo "<p>Erreur lors de la création de l'administrateur.</p>";
        }
    } catch (Exception $e) {
        // Affichage de l'erreur en cas d'échec
        die('Erreur : ' . $e->getMessage());
    }
}
