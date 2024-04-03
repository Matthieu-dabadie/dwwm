<style>
    .navbar-nav .nav-link {
        transition: all 0.2s ease-in-out;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link:focus {
        color: #007bff;
        transform: scale(1.05);
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary" id="secondaryNavbar">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($navLinks as $link) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= htmlspecialchars($link['path'] ?? '#'); ?>"><?= htmlspecialchars($link['name'] ?? 'Lien manquant'); ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>