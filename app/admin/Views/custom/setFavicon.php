<?php $title = "Définir le Favicon"; ?>

<div class="container mt-5">
    <h2>Définir le Favicon</h2>
    <form action="?controller=favicon&action=saveFavicon" method="post" enctype="multipart/form-data">
        <div class="mb-3 input-desktop-width">
            <label for="favicon" class="form-label">Choisissez un fichier pour le favicon :</label>
            <input type="file" class="form-control form-control-sm" id="favicon" name="favicon" accept="image/png, image/jpeg, image/gif">
        </div>
        <div>
            <button type="submit" class="btn btn-primary btn-sm">Télécharger</button>
        </div>
    </form>
</div>