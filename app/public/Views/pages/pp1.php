<?php
$title = htmlspecialchars($pageData['name']);
?>


<section class="articles-container d-flex flex-column align-items-stretch">
    <?php foreach ($articlesData as $index => $article) : ?>
        <div class="article-bubble p-3 mb-4 <?= ($index % 2 === 0) ? 'align-self-end' : 'align-self-start' ?>" style="background-color: <?= htmlspecialchars($article['background_color']) ?>; opacity: <?= htmlspecialchars($article['transparency'] ?? '1') ?>; border: 2px solid <?= htmlspecialchars($article['frameColor'] ?? '#000') ?>; border-radius: 15px; max-width: 70%;">
            <h2 class="article-title"><?= htmlspecialchars($article['title']) ?></h2>
            <div><?= nl2br(htmlspecialchars($article['content'])) ?></div>
            <?php if (!empty($article['image_path'])) : ?>
                <img src="/app/public/<?= htmlspecialchars($article['image_path']) ?>" alt="Image de l'article" style="max-width: 100%; height: auto;">
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</section>