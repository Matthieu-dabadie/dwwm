<?php $title = "Image du bandeau"; ?>


<head>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<div class="container">
    <div id="mobileWarning" style="display: none;" class="alert alert-warning">
        Fonction en cours de création, indisponible sur mobile et tablette pour le moment. Vous serez redirigé vers le tableau de bord dans <span id="countdown">5</span> secondes.
    </div>

    <h2>Modifier l'image du bandeau</h2>
    <input type="file" id="inputImage" accept="image/*" class="form-control mb-2">
    <canvas id="imageCanvas" width="728" height="90"></canvas>
    <button id="saveButton" class="btn btn-primary mt-2">Save Cropped Image</button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var width = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

        if (width < 768) {
            Swal.fire({
                title: 'Fonctionnalité en développement',
                text: "Nous travaillons dur pour rendre cette fonctionnalité accessible sur mobile. En attendant, veuillez utiliser un ordinateur de bureau pour accéder à cette page.",
                icon: 'info',
                confirmButtonText: 'Retour au tableau de bord',
                confirmButtonColor: '#3085d6',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php?controller=home&action=index';
                }
            });
        }
    });
</script>