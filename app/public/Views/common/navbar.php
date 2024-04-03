<nav class="navbar navbar-expand-lg navbar-light bg-dark" id="primaryNavbar">
    <div class="container-fluid">
        <a class="navbar-brand text-light" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <form class="d-flex" role="search" action="index.php" method="get">
                <input class="form-control me-2" type="search" name="q" placeholder="Rechercher" aria-label="Search">
                <input type="hidden" name="controller" value="search">
                <input type="hidden" name="action" value="index">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </form>

            <ul class="navbar-nav ms-5">
                <li class="nav-item ">
                    <a class="nav-link text-light" href="?controller=contact&action=index">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="../admin/index.php?controller=login&action=index">Accès Réservé</a>
                </li>
                <ul class="navbar-nav ms-auto">
                    <!-- Affichage conditionnel des icônes de réseaux sociaux -->
                    <?php foreach ($socialLinks as $platform => $url) : ?>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="<?= htmlspecialchars($url); ?>" target="_blank">
                                <i class="fab fa-<?= htmlspecialchars($platform); ?>"></i>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </ul>
            </ul>
        </div>
    </div>
</nav>