<div class="my-5" id="customFooter">
    <footer class="footer-upper" id="footerUpper">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-4">
                    <div class="row text-center pt-2 pb-2">
                        <!-- Colonne de gauche -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <ul class="list-unstyled">
                                <?php foreach ($footerLinks as $link) : ?>
                                    <?php if ($link['column'] == 'left') : ?>
                                        <li><a href="<?= htmlspecialchars($link['url']) ?>" class="link-light"><?= htmlspecialchars($link['name']) ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Colonne du milieu -->
                        <div class="col-md-4 mb-4 mb-md-0">
                            <ul class="list-unstyled">
                                <?php foreach ($footerLinks as $link) : ?>
                                    <?php if ($link['column'] == 'middle') : ?>
                                        <li><a href="<?= htmlspecialchars($link['url']) ?>" class="link-light"><?= htmlspecialchars($link['name']) ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- Colonne de droite -->
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li><a href="index.php?controller=pagesStatic&action=conditions" class="link-light">Conditions d'utilisation</a></li>
                                <li><a href="index.php?controller=pagesStatic&action=mentions" class="link-light">Mentions légales</a></li>
                                <li><a href="index.php?controller=pagesStatic&action=faq" class="link-light">FAQ</a></li>
                                <li><a href="index.php?controller=pagesStatic&action=planSite" class="link-light">Plan du site</a></li>
                                <?php foreach ($footerLinks as $link) : ?>
                                    <?php if ($link['column'] == 'right') : ?>
                                        <li><a href="<?= htmlspecialchars($link['url']) ?>" class="link-light"><?= htmlspecialchars($link['name']) ?></a></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- Copyright -->
    <div class="footer-lower text-center p-3" id="footerLower">
        <p class="footer-text">Matthieu Dabadie-Courtin © 2024 Copyright</p>
    </div>
</div>