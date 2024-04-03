<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Administrateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<div class="container">
    <div class="row my-5 justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Connexion Administrateur</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['error']) && $_GET['error'] == 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            Identifiant ou mot de passe incorrect.
                        </div>
                    <?php endif; ?>
                    <form action="index.php?controller=login&action=login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Adresse E-mail</label>
                            <input type="email" class="form-control" id="username" name="username" placeholder="Entrez votre adresse e-mail" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                        </div>
                        <!-- Affichage du message d'erreur si nécessaire -->
                        <?php if (isset($_GET['error']) && $_GET['error'] === 'login') : ?>
                            <div class="alert alert-danger" role="alert">
                                Identifiant ou mot de passe incorrect.
                            </div>
                        <?php endif; ?>
                    </form>

                    <p class="mt-3"><a href="?controller=passwordReset&action=showResetRequestForm">Mot de passe oublié ?</a></p>

                    <p class="mt-3"><a href="../public/index.php">Retour à la page d'accueil</a></p>
                </div>
            </div>
        </div>
    </div>
</div>