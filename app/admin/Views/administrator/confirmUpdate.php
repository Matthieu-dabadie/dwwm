<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\admin\Controllers\ConfirmationController;

session_start(); // Assurez-vous que la session est démarrée

if (isset($_POST['token']) && isset($_POST['password'])) {
    $controller = new ConfirmationController();
    $controller->updatePassword($_POST['token'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour du mot de passe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Mise à jour du mot de passe
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['message'])) : ?>
                            <p class="card-text"><?php echo $_SESSION['message']; ?></p>
                            <?php unset($_SESSION['message']); ?>
                        <?php else : ?>
                            <p class="card-text">Une erreur s'est produite. Veuillez réessayer.</p>
                        <?php endif; ?>
                        <a href="/app/admin/index.php?controller=login&action=index" class="btn btn-primary">Retour à la connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>