<?php $title = "Gestion des Administrateurs";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?controller=login&action=index");
    exit;
}

?>

<div class="container mt-3 pb-5">
    <div class="mb-4">
        <h2 class="fw-bold text-secondary">Gestion des Administrateurs</h2>
    </div>

    <div class="mb-3">
        <a href="?controller=admin&action=add" class="btn btn-outline-success"><i class="fas fa-plus"></i> Ajouter un administrateur</a>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-4">
        <?php foreach ($admins as $admin) : ?>
            <div class="col">
                <div class="card border-secondary">
                    <div class="card-header text-white bg-secondary">
                        ID: <?= htmlspecialchars($admin->id) ?>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title mb-3">Nom: <?= htmlspecialchars($admin->username) ?></h6>
                        <div class="d-flex justify-content-center gap-2">
                            <!-- <a href="?controller=admin&action=edit&id=<?= $admin->id ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> Modifier</a> -->
                            <a href="?controller=admin&action=delete&id=<?= $admin->id ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Êtes-vous sûr ?');"><i class="fas fa-trash"></i> Supprimer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4">
        <a href="?controller=home&action=index" class="btn btn-outline-info"><i class="fas fa-home"></i> Accueil</a>
    </div>
</div>