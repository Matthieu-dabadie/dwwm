<?php $title = "Éditer les Pages Dynamiques"; ?>

<div class="container mt-5">
    <h2>Éditer une Page Dynamique</h2>
    <form action="index.php?controller=dynamicPage&action=editSelectedPage" method="get">
        <input type="hidden" name="controller" value="dynamicPage">
        <input type="hidden" name="action" value="editSelectedPage">
        <div class="mb-3">
            <label for="pageSelect" class="form-label">Sélectionnez une page</label>
            <select class="form-select input-desktop-width" id="pageSelect" name="id">
                <?php foreach ($pages as $page) : ?>
                    <option value="<?= $page['id']; ?>"><?= htmlspecialchars($page['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary my-5">Éditer la page</button>
    </form>
</div>