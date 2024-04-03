<?php $title = "Gestion des Administrateurs";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("Location: index.php?controller=login&action=index");
    exit;
}
?>


<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-light text-center">
                    <h2 class="mb-0">Ajouter un Administrateur</h2>
                </div>
                <div class="card-body p-4">
                    <div id="successMessage" class="alert alert-success d-none" role="alert">
                        L'invitation a été envoyée avec succès.
                    </div>
                    <form id="addAdminForm">
                        <div class="mb-3">
                            <label for="username" class="form-label">Adresse E-mail</label>
                            <input type="email" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="?controller=admin&action=manage" class="btn btn-outline-secondary">Retour à la gestion</a>
                            <div>
                                <button type="submit" class="btn btn-primary">Envoyer l'invitation</button>
                                <a href="?controller=admin&action=manage" class="btn btn-secondary ms-2">Annuler</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="mt-4 text-center">
                <a href="?controller=admin&action=manage" class="btn btn-outline-info">Retour à la gestion des Administrateurs</a>
            </div>
        </div>
    </div>
</div>



<script>
    document.getElementById('addAdminForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Empêcher la soumission standard du formulaire

        var formData = new FormData(this);

        fetch('?controller=admin&action=addAdmin', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('successMessage').classList.remove('d-none'); // Afficher la pop-up de succès
                    setTimeout(function() {
                        document.getElementById('successMessage').classList.add('d-none'); // Optionnel: cacher la pop-up après quelques secondes
                    }, 5000); // 5 secondes avant de cacher la pop-up
                } else {
                    alert('L\'invitation n\'a pas pu être envoyée.');
                }
            })
            .catch(error => {
                alert('Erreur: ' + error);
            });
    });
</script>