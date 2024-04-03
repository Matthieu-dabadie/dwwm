<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .info-bulle {
            display: none;
            /* Initialement caché */
            background-color: black;
            color: white;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 100%;
            left: 50%;
            margin-left: -60px;
            /* Centre la bulle */
        }

        .info-bulle-container {
            position: relative;
            display: inline-block;
        }

        .info-bulle-container:hover .info-bulle {
            display: block;
            /* Afficher au survol */
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Réinitialiser le mot de passe
                    </div>
                    <div class="card-body">
                        <form action="index.php?controller=passwordReset&action=handleResetPassword" method="post">
                            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
                            <div class="form-group">
                                <label for="password">Nouveau mot de passe :</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Réinitialiser</button>
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