<?php $title = "Gestion de l'Image de Fond"; ?>

<div class="container mt-5">
    <h2><?= $title; ?></h2>
    <form action="index.php?controller=background&action=saveBackground" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="backgroundImage" class="form-label">Image de fond</label>
            <input type="file" class="form-control" id="backgroundImage" name="backgroundImage">
        </div>
        <div class="mb-3">
            <label class="form-label">Type de conteneur</label>
            <select class="form-select" name="containerType">
                <option value="container">Cadre standard</option>
                <option value="container-fluid">Pleine largeur</option>
            </select>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="noBackground" name="noBackground">
            <label class="form-check-label" for="noBackground">No background image</label>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>