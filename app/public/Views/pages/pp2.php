<?php
$title = htmlspecialchars($pageData['slug']);
?>


<!-- Affichage des actualités -->

<section class="news-container d-flex flex-column align-items-stretch">
    <?php foreach ($newsData as $index => $news) : ?>
        <div class="news-bubble p-3 mb-4 <?= ($index % 2 === 0) ? 'align-self-end' : 'align-self-start' ?>" style="background-color: <?= htmlspecialchars($news['background_color']) ?>; 
                   border: 2px solid <?= htmlspecialchars($news['frame_color']) ?>; 
                   border-radius: 15px; 
                   max-width: 70%;">
            <div style="opacity: <?= htmlspecialchars($news['transparency']) ?>;">
                <h2><?= htmlspecialchars($news['title']) ?></h2>
                <div><?= nl2br(htmlspecialchars($news['content'])) ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</section>