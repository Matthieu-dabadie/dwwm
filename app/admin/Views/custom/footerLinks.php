<?php $title = "Gérer les liens du footer"; ?>

<div class="container mt-4">
    <form id="linksForm" method="POST" action="index.php?controller=footerLinks&action=save">
        <?php
        $columns = [
            'left' => 'Ajouter des liens dans la colonne de gauche (7 max)',
            'middle' => 'Ajouter des liens dans la colonne du milieu (7 max)',
            'right' => 'Ajouter des liens dans la colonne de droite (3 max)'
        ];
        foreach ($columns as $column => $label) : ?>
            <div class="links-group">
                <h3><?= $label ?></h3>
                <?php foreach ($links as $index => $link) :
                    if ($link['column'] == $column) : ?>
                        <div class="mb-3">
                            <input type="hidden" name="links[<?= $index ?>][id]" value="<?= $link['id'] ?>">
                            <input type="text" name="links[<?= $index ?>][name]" class="form-control mb-2" placeholder="Nom du lien" value="<?= htmlspecialchars($link['name']) ?>">
                            <input type="url" name="links[<?= $index ?>][url]" class="form-control mb-2" placeholder="URL" value="<?= htmlspecialchars($link['url']) ?>">
                            <input type="hidden" name="links[<?= $index ?>][column]" value="<?= $column ?>">
                        </div>
                <?php endif;
                endforeach; ?>
                <button type="button" class="btn btn-primary addLinkButton" data-column="<?= $column ?>">Ajouter un lien</button>
                <div class="link-error-msg" style="display: none; color: red;"></div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-success my-5">Sauvegarder</button>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const maxLinks = {
            left: 7,
            middle: 7,
            right: 3
        };

        // Initialiser le compteur de liens par colonne
        const linkCount = {
            left: 0,
            middle: 0,
            right: 0
        };

        // Mise à jour du compteur basée sur le contenu initial du formulaire
        document.querySelectorAll('.links-group').forEach(group => {
            const column = group.querySelector('.addLinkButton').getAttribute('data-column');
            linkCount[column] = group.querySelectorAll('.mb-3').length;
        });

        document.querySelectorAll('.addLinkButton').forEach(button => {
            button.addEventListener('click', function() {
                const column = this.dataset.column;

                if (linkCount[column] >= maxLinks[column]) {
                    // Afficher un message d'erreur si la limite est atteinte
                    const errorMsg = this.nextElementSibling;
                    errorMsg.textContent = `Limite de ${maxLinks[column]} liens atteinte pour la colonne ${column}.`;
                    errorMsg.style.display = 'block';

                    // Cacher le message d'erreur après quelques secondes
                    setTimeout(() => errorMsg.style.display = 'none', 3000);
                    return;
                }

                linkCount[column]++; // Incrémente le compteur pour la colonne

                // Ajoute un nouvel input
                const newIndex = new Date().getTime(); // Utiliser le timestamp comme index unique
                const inputGroup = document.createElement('div');
                inputGroup.className = 'mb-3';
                inputGroup.innerHTML = `
                <input type="hidden" name="links[${newIndex}][id]" value="">
                <input type="text" name="links[${newIndex}][name]" class="form-control mb-2" placeholder="Nom du lien">
                <input type="url" name="links[${newIndex}][url]" class="form-control mb-2" placeholder="URL">
                <input type="hidden" name="links[${newIndex}][column]" value="${column}">
            `;
                this.parentNode.insertBefore(inputGroup, this);

                // Réinitialiser le message d'erreur
                const errorMsg = this.nextElementSibling;
                errorMsg.style.display = 'none';
            });
        });
    });
</script>