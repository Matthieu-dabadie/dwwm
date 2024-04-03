<?php $title = "Gestion des Administrateurs";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?controller=login&action=index");
    exit;
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1 class="mb-4">Éditer l'Administrateur</h1>
            <form action="?controller=admin&action=saveEdit&id=<?= htmlspecialchars($admin->id) ?>" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Adresse E-mail</label>
                    <input type="email" class="form-control" id="username" name="username" value="<?= htmlspecialchars($admin->username) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Nouveau mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-3">
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    <a href="?controller=admin&action=manage" class="btn btn-secondary ms-2">Annuler</a>
                </div>
            </form>
            <div class="mt-4">
                <a href="index.php?controller=admin&action=manage" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Gestion des Administrateurs</a>
                <a href="?controller=home&action=index" class="btn btn-outline-info ms-2"><i class="fas fa-home"></i> Accueil</a>
            </div>
        </div>
    </div>
</div>