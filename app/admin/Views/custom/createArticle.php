<?php $title = "Ajouter un article"; ?>

<!-- Affichage des alertes -->
<?php
$alertTypes = [
    'article_delete_success' => 'alert-success',
    'article_delete_error' => 'alert-danger',
];

foreach ($alertTypes as $key => $class) {
    if (isset($_SESSION[$key])) {
        echo "<div class='alert {$class}' role='alert'>" . htmlspecialchars($_SESSION[$key]) . "</div>";
        unset($_SESSION[$key]);
    }
}
?>

<div class="container mt-5">
    <h2 class="mb-4"><?= $title ?></h2>
    <form action="?controller=content&action=storeArticle" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label ">Titre de l'article</label>
            <input type="text" class="form-control input-desktop-width" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu de l'article</label>
            <textarea class="form-control input-desktop-width" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="backgroundColor" class="form-label">Couleur de fond (Hex)</label>
            <input type="color" class="form-control form-control-color" id="backgroundColor" name="backgroundColor" value="#ffffff">
        </div>
        <div class="mb-3" style="width: 100%; max-width: 200px;">
            <label for="transparency" class="form-label">Transparence (0-1)</label>
            <input type="number" class="form-control" id="transparency" name="transparency" min="0" max="1" step="0.1" value="1">
        </div>
        <div class="mb-3" style="width: 100%; max-width: 200px;">
            <label for="frameColor" class="form-label">Couleur du cadre (Hex)</label>
            <input type="color" class="form-control" id="frameColor" name="frameColor" value="#000000">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image (optionnel)</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>

        <div id="preview" style="width: 100%; max-width: 300px; height: 100px; margin-top: 20px; border: 2px solid; border-radius: 10px; display: flex; justify-content: center; align-items: center; padding: 10px;">
            Texte pour visualiser la couleur, la transparence, et le cadre
        </div>

        <button type="submit" class="my-3 btn btn-primary">Ajouter</button>
    </form>
</div>
<hr>
<div class="container mt-5">
    <h2>Supprimer un article</h2>
    <form action="?controller=content&action=deleteArticle" method="post">
        <div class="mb-3" style="width: 100%; max-width: 300px;">
            <label for="articleId" class="form-label">Sélectionnez un article à supprimer</label>
            <select class="form-control" id="articleId" name="articleId" required>
                <?php foreach ($articles as $article) : ?>
                    <option value="<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger">Supprimer</button>
    </form>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const backgroundColorInput = document.getElementById('backgroundColor');
        const transparencyInput = document.getElementById('transparency');
        const frameColorInput = document.getElementById('frameColor');
        const previewDiv = document.getElementById('preview');

        function updatePreview() {
            const transparency = transparencyInput.value;
            const color = backgroundColorInput.value;
            const frameColor = frameColorInput.value;
            previewDiv.style.backgroundColor = `rgba(${parseInt(color.substr(1, 2), 16)}, ${parseInt(color.substr(3, 2), 16)}, ${parseInt(color.substr(5, 2), 16)}, ${transparency})`;
            previewDiv.style.borderColor = frameColor;
        }

        backgroundColorInput.addEventListener('input', updatePreview);
        transparencyInput.addEventListener('input', updatePreview);
        frameColorInput.addEventListener('input', updatePreview);

        updatePreview();
    });
</script>