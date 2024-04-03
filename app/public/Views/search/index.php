<?php $title = "Résultats de recherche"; ?>

<div class="container blocSearch mt-5">
    <h2>Résultats de recherche pour "<?= htmlspecialchars($searchTerm); ?>"</h2>

    <?php if (empty($results)) : ?>
        <p>Aucun article trouvé.</p>
    <?php else : ?>
        <div class="list-group mt-3">
            <?php foreach ($results as $article) : ?>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1"><?= htmlspecialchars($article['title']); ?></h5>
                    <p class="mb-1"><?= htmlspecialchars(substr($article['content'], 0, 150)) . '...'; ?></p>
                </a>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>