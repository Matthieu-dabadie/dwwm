<?php $title = "Ajouter une actualité"; ?>

<!-- Affichage des alertes -->
<?php
$alertTypes = [
    'news_add_success' => 'alert-success',
    'news_add_error' => 'alert-danger',
    'news_delete_success' => 'alert-success',
    'news_delete_error' => 'alert-danger',
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
    <form action="?controller=news&action=store" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Titre de l'actualité</label>
            <input type="text" class="form-control input-desktop-width" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Contenu de l'actualité</label>
            <textarea class="form-control input-desktop-width" id="content" name="content" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="backgroundColor" class="form-label">Couleur de fond (Hex)</label>
            <input type="color" class="form-control form-control-color" id="backgroundColor" name="backgroundColor" value="#ffffff">
        </div>
        <div class="mb-3">
            <label for="transparency" class="form-label">Transparence (0-1)</label>
            <input type="number" class="form-control input-desktop-width" id="transparency" name="transparency" min="0" max="1" step="0.1" value="1">
        </div>
        <div class="mb-3">
            <label for="frameColor" class="form-label">Couleur du cadre (Hex)</label>
            <input type="color" class="form-control input-desktop-width" id="frameColor" name="frameColor" value="#000000">
        </div>

        <div id="preview" style="width: 100%; max-width: 300px; height: 100px; margin-top: 20px; border: 2px solid; border-radius: 10px; display: flex; justify-content: center; align-items: center; padding: 10px;">
            Texte pour visualiser la couleur, la transparence, et le cadre
        </div>

        <button type="submit" class="my-3 btn btn-primary">Ajouter</button>
    </form>
</div>

<hr>

<div class="container mt-5">
    <h2>Supprimer une actualité</h2>
    <form action="?controller=news&action=deleteNews" method="post">
        <div class="mb-3">
            <label for="newsId" class="form-label">Sélectionnez une actualité à supprimer</label>
            <select class="form-control input-desktop-width" id="newsId" name="newsId" required>
                <?php foreach ($newss as $news) : ?>
                    <option value="<?= $news['id']; ?>"><?= htmlspecialchars($news['title']); ?></option>
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
            const transparencyValue = transparencyInput.value;
            const color = backgroundColorInput.value;
            const frameColor = frameColorInput.value;
            previewDiv.style.backgroundColor = `rgba(${parseInt(color.substr(1, 2), 16)}, ${parseInt(color.substr(3, 2), 16)}, ${parseInt(color.substr(5, 2), 16)}, ${transparencyValue})`;
            previewDiv.style.borderColor = frameColor;
        }

        backgroundColorInput.addEventListener('input', updatePreview);
        transparencyInput.addEventListener('input', updatePreview);
        frameColorInput.addEventListener('input', updatePreview);

        updatePreview();
    });
</script>