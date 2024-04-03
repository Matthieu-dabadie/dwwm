<?php $title = "Éditer la Page Sélectionnée"; ?>

<div class="container mt-5">
    <h2>Édition de la Page : <?= htmlspecialchars($pageData['name']); ?></h2>
    <form action="index.php?controller=dynamicPage&action=saveEditedPage" method="post">
        <input type="hidden" name="pageId" value="<?= $pageData['id']; ?>">
        <textarea id="summernote" name="content"><?= htmlspecialchars($pageData['content']); ?></textarea>
        <button type="submit" class="btn btn-success mt-3">Sauvegarder les changements</button>
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