<?php $title = "Plan de Site"; ?>

<style>
    .bg-dark-transparent {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 20px;
        border-radius: 15px;
    }

    .container-plan {
        max-width: 800px;
        margin: auto;
    }

    a.link-light:hover {
        text-decoration: underline;
    }
</style>

<div class="container mt-5 d-flex justify-content-center">
    <div class="container-plan">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h1 class="card-title">Plan du site</h1>
                <ul class="list-unstyled">
                    <?php foreach ($navLinks as $link) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="<?= htmlspecialchars($link['path'] ?? '#'); ?>"><?= htmlspecialchars($link['name'] ?? 'Lien manquant'); ?></a>
                        </li>
                    <?php endforeach; ?>

                    <li><a class="nav-link text-white" href="index.php?controller=faq">FAQ</a></li>
                    <li><a class="nav-link text-white" href="index.php?controller=terms">Conditions d'utilisation</a></li>
                    <li><a class="nav-link text-white" href="index.php?controller=legal">Mentions légales</a></li>
                    <li><a class="nav-link text-white" href="index.php?controller=privacy">Politique de confidentialité</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>