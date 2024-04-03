<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de réinitialisation de mot de passe</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Demande de réinitialisation de mot de passe
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['flash_message'])) : ?>
                            <div class="alert alert-<?php echo $_SESSION['flash_message_type']; ?>">
                                <?php echo $_SESSION['flash_message']; ?>
                            </div>
                        <?php
                            // Supprimer le message après l'avoir affiché
                            unset($_SESSION['flash_message']);
                            unset($_SESSION['flash_message_type']);
                        endif; ?>
                        <form action="?controller=passwordReset&action=sendResetLink" method="post">
                            <div class="form-group">
                                <label for="email">Adresse E-mail :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
                                <a href="index.php?controller=login&action=index" class="btn mx-5 btn-outline-info"><i class="fas fa-home"></i> Retour</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>