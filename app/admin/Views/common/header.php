<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark" style="min-height: 80px;">
        <div class="container-fluid">
            <a class="navbar-brand text-light" href="index.php?controller=home&action=index">Tableau de bord</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../public/index.php" target="_blank">
                            <i class="fas fa-external-link-alt"></i>
                            Site public
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="?controller=admin&action=manage">
                            <i class="fas fa-users-cog"></i>
                            Gestion des comptes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="?controller=login&action=logout">
                            <i class="fas fa-sign-out-alt"></i>
                            Déconnexion
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>