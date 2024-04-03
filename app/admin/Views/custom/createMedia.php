<?php $title = "Médiathèque"; ?>

<div class="container mt-5">
    <h2>Médiathèque</h2>
    <form id="mediaForm" action="index.php?controller=media&action=processUpload" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="albumTitle" class="form-label">Titre de l'album :</label>
            <input type="text" class="form-control" id="albumTitle" name="albumTitle" required>
        </div>
        <div id="fileInputsContainer">
            <div class="mb-3">
                <label for="media0" class="form-label">Sélectionner des photos ou vidéos :</label>
                <input type="file" class="form-control" id="media0" name="media[]" accept="image/*, video/*" multiple onchange="handleFiles(this)">
            </div>
        </div>
        <button type="button" id="addMoreFilesButton" class="btn btn-info">Ajouter plus de fichiers</button>
        <div class="my-5" id="previewContainer"></div>
        <button type="submit" class="btn btn-primary mt-3">Valider l'album</button>
    </form>
</div>


<!-- Affichage des alertes -->
<?php
$alertTypes = [
    'media_delete_success' => 'alert-success',
    'media_delete_error' => 'alert-danger',
];

foreach ($alertTypes as $key => $class) {
    if (isset($_SESSION[$key])) {
        echo "<div class='alert {$class}' role='alert'>" . htmlspecialchars($_SESSION[$key]) . "</div>";
        unset($_SESSION[$key]); // Supprime la notification de la session pour éviter l'affichage répété
    }
}
?>



<!-- Formulaire de suppression d'album -->
<div class="container mt-5">
    <h2>Supprimer un album</h2>
    <form id="deleteAlbumForm" action="index.php?controller=media&action=deleteAlbum" method="post">
        <div class="mb-3">
            <label for="albumToDelete" class="form-label">Sélectionner l'album à supprimer :</label>
            <select class="form-control" id="albumToDelete" name="albumId">
                <?php foreach ($albums as $album) : ?>
                    <option value="<?= htmlspecialchars($album['id']) ?>"><?= htmlspecialchars($album['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Supprimer l'album</button>
    </form>
</div>



<script>
    let fileInputCount = 1;

    document.getElementById('addMoreFilesButton').addEventListener('click', function() {
        const fileInputsContainer = document.getElementById('fileInputsContainer');
        const newFileInput = document.createElement('div');
        newFileInput.classList.add('mb-3');
        newFileInput.innerHTML = `
                <label for="media${fileInputCount}" class="form-label">Sélectionner des photos ou vidéos :</label>
                <input type="file" class="form-control" id="media${fileInputCount}" name="media[]" accept="image/*, video/*" multiple onchange="handleFiles(this)">
            `;
        fileInputsContainer.appendChild(newFileInput);
        fileInputCount++;
    });

    function handleFiles(input) {
        const files = input.files;
        const previewContainer = document.getElementById("previewContainer");
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const mediaElement = file.type.startsWith("video/") ? document.createElement("video") : document.createElement("img");
                mediaElement.src = e.target.result;
                if (mediaElement.tagName === "VIDEO") {
                    mediaElement.controls = true;
                }
                mediaElement.classList.add("preview-item");
                previewContainer.appendChild(mediaElement);
            };
            reader.readAsDataURL(file);
        });
    }
</script>