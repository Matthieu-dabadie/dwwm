<?php $title = "Ajouter ou supprimer une page"; ?>
<div class="container mt-5">
    <h2>Gérer les pages</h2>

    <!-- Formulaire d'ajout de page -->
    <div class="mb-5">
        <h3>Ajouter une nouvelle page</h3>
        <form id="addPageForm" method="POST" action="index.php?controller=page&action=storePage">
            <div class="mb-3 input-desktop-width">
                <label for="pageName" class="form-label">Nom de la page</label>
                <input type="text" class="form-control" id="pageName" name="name" placeholder="Entrez le nom de la page" required>
            </div>

            <div class="mb-3 input-desktop-width">
                <label for="pageContent" class="form-label">Contenu de la page (facultatif)</label>
                <textarea class="form-control" id="pageContent" name="content" rows="10" placeholder="Écrivez le contenu de la page ici ou utiliser l'éditeur de texte dans modifier une page."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter la page</button>
        </form>
    </div>

    <!-- Formulaire de suppression de page -->
    <div>
        <h3>Supprimer une page existante</h3>
        <form id="deletePageForm" method="POST" action="index.php?controller=page&action=deletePage">
            <div class="mb-3 input-desktop-width">
                <label for="deletePageSelect" class="form-label">Sélectionnez une page à supprimer</label>
                <select class="form-control" id="deletePageSelect" name="pageId">
                    <?php foreach ($pages as $page) : ?>
                        <option value="<?= $page['id'] ?>" <?= $page['is_protected'] ? 'disabled' : '' ?>><?= htmlspecialchars($page['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Supprimer la page</button>
        </form>
    </div>
</div>

<script>
    function confirmDelete() {
        const pageName = document.querySelector('#deletePageSelect option:checked').text;
        const confirmInput = prompt(`Veuillez confirmer la suppression de la page '${pageName}' en écrivant son nom :`);

        if (confirmInput === pageName) {
            document.getElementById('deletePageForm').submit();
        } else {
            alert("La suppression a été annulée ou le nom de la page ne correspond pas.");
        }
    }
</script>