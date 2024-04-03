<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Confirmation de réinitialisation du mot de passe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($_SESSION['flash_message'])) : ?>
                            <div class="alert alert-<?php echo htmlspecialchars($_SESSION['flash_message_type']); ?>" role="alert">
                                <?php echo htmlspecialchars($_SESSION['flash_message']); ?>
                            </div>
                            <a href="index.php?controller=login&action=index" class="btn btn-primary">Se connecter</a>
                            <?php
                            unset($_SESSION['flash_message']);
                            unset($_SESSION['flash_message_type']);
                            ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>