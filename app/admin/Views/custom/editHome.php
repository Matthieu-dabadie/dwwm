<?php $title = "Gestion page accueil"; ?>

<div class="container">
    <!-- Formulaire pour éditer le contenu de la page d'accueil -->
    <form method="post" action="?controller=home&action=saveHomeContent">
        <!-- Le textarea reste caché mais contient le contenu initial pour le soumettre -->
        <textarea name="homeContent" id="homeContent" style="display:none;"><?= htmlspecialchars($homeContent ?? ''); ?></textarea>

        <!-- Summernote sera initialisé avec le contenu de cette div -->
        <div id="summernote"><?= htmlspecialchars($homeContent ?? ''); ?></div>

        <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
    </form>
</div>
<script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 600,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ],
        callbacks: {
            onChange: function(contents, $editable) {
                // Mettre à jour le contenu du textarea caché avec le contenu de Summernote
                $('#homeContent').val(contents);
            }
        }
    });
    // Initialise Summernote avec le contenu stocké (si disponible)
    $('#summernote').summernote('code', $('#homeContent').val());
</script>