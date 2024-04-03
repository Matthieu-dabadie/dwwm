<?php $title = "Tableau de bord";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Bouton de bascule pour la sidebar sur mobile -->
            <button class="btn btn-primary d-md-none" type="button" data-toggle="collapse" data-target="#sidebar" aria-expanded="false" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon">Menu</span>
            </button>


            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block bg-dark sidebar collapse" id="sidebar">
                <div class="sidebar-sticky">
                    <div class="sidebar-heading"></div>
                    <ul class="nav flex-column">
                        <!-- Lien de menu avec attribut de données -->
                        <a class="nav-link" href="?controller=favicon&action=setFavicon" data-toggle="tooltip" title="Gérer les icônes de favoris pour votre site">
                            <i class="fas fa-chart-bar"></i>
                            Gérer le Favicon
                        </a>

                        <li class="nav-item">
                            <a class="nav-link active" href="?controller=banner&action=editBanner" data-toggle="tooltip" title="Modifier l'image de votre bandeau principal">
                                <i class="fas fa-image"></i>
                                Image du bandeau
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=background&action=setBackground" data-toggle="tooltip" title="Configurer l'image de fond de votre site">
                                <i class="fas fa-image"></i>
                                Gestion de l'Image de Fond
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?controller=home&action=showColors" id="colorManagementLink" data-toggle="tooltip" title="Personnaliser les couleurs de votre site">
                                <i class="fas fa-palette"></i>
                                Gestion des couleurs
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?controller=nav&action=editNav" data-toggle="tooltip" title="Éditer les éléments de votre barre de navigation">
                                <i class="fas fa-edit"></i>
                                Gestion Navigation
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="?controller=page&action=addPage" data-toggle="tooltip" title="Ajouter ou modifier des pages personnalisées à votre site">
                                <i class="fas fa-plus"></i>
                                Gérer les pages personnalisées
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?controller=dynamicPage&action=edit" data-toggle="tooltip" title="Configurer et éditer le contenu des pages dynamiques">
                                <i class="fas fa-cogs"></i>
                                Éditer les pages utilisateur
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?controller=home&action=editHome" data-toggle="tooltip" title="Gérer le contenu et le layout de la page d'accueil">
                                <i class="fas fa-chart-bar"></i> Gérer la page d'accueil
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=content&action=createArticle" data-toggle="tooltip" title="Créer et gérer les articles de votre blog ou de vos news">
                                <i class="fas fa-newspaper"></i>
                                Gérer les articles
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=news&action=create" data-toggle="tooltip" title="Publier des actualités ou des annonces sur votre site">
                                <i class="fas fa-broadcast-tower"></i>
                                Gérer les actualités
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=media&action=create" data-toggle="tooltip" title="Créer et gérer des albums photo ou galerie de médias">
                                <i class="fas fa-images"></i>
                                Gérer les albums
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=agenda&action=createAgenda" data-toggle="tooltip" title="Planifier et annoncer des événements à venir">
                                <i class="fas fa-calendar-alt"></i>
                                Gérer l'agenda
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=social&action=edit" data-toggle="tooltip" title="Gérer les liens sociaux">
                                <i class="fas fa-share-alt"></i>
                                Gérer les liens sociaux
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="index.php?controller=footerLinks&action=edit" data-toggle="tooltip" title="Éditez le contenu du footer de votre site">
                                <i class="fas fa-cogs"></i>
                                Éditer le Footer
                            </a>
                        </li>

                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cogs"></i>
                                menu vide
                            </a>
                        </li> -->
                        <br>
                        <li class="nav-item d-none d-md-block">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="toggleTooltips" checked>
                                <label class="custom-control-label" for="toggleTooltips">Activer les infos-bulles</label>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>


            <!-- Contenu principal -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="overflow: hidden;">
                <div class="col-3">

                    <!-- Affichage des alertes -->
                    <div class="alert-container">
                        <?php
                        $alertTypes = [
                            'color_update_success' => 'alert-success',
                            'home_update_success' => 'alert-success',
                            'banner_update_success' => 'alert-success',
                            'nav_update_success' => 'alert-success',
                            'page_add_success' => 'alert-success',
                            'page_add_error' => 'alert-danger',
                            'page_edit_success' => 'alert-success',
                            'page_edit_error' => 'alert-danger',
                            'background_update_success' => 'alert-success',
                            'background_update_error' => 'alert-danger',
                            'favicon_update_success' => 'alert-success',
                            'favicon_update_error' => 'alert-danger',
                            'article_add_success' => 'alert-success',
                            'article_add_error' => 'alert-danger',
                            'article_delete_success' => 'alert-success',
                            'article_delete_error' => 'alert-danger',
                            'news_add_success' => 'alert-success',
                            'news_add_error' => 'alert-danger',
                            'media_add_success' => 'alert-success',
                            'media_add_error' => 'alert-danger',
                            'event_add_success' => 'alert-success',
                            'event_add_error' => 'alert-danger',
                            'social_links_update_success' => 'alert-success',
                            'social_links_update_error' => 'alert-danger',
                            'footer_links_update_success' => 'alert-success',
                            'footer_links_update_error' => 'alert-danger',
                        ];

                        foreach ($alertTypes as $key => $class) {
                            if (isset($_SESSION[$key])) {
                                echo "<div class='alert {$class} alert-text-small mx-3 my-1' role='alert'>" . htmlspecialchars($_SESSION[$key]) . "</div>";
                                unset($_SESSION[$key]);
                            }
                        }
                        ?>
                    </div>



                </div>
                <div class="row">
                    <div class="col-md-10 my-">
                        <div class="card">
                            <div class="card-body">
                                <!-- Fenêtre de visualisation du site public -->
                                <div style="width: 100%; height: 750px; overflow-x: auto; overflow-y: hidden;">
                                    <iframe id="sitePreview" src="/app/public/index.php" style="width: 100%; height: 100%; border: none;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <script>
        $(document).ready(function() {

            function toggleTooltips(enable) {
                if (enable) {
                    $('[data-toggle="tooltip"]').tooltip('enable');
                } else {
                    $('[data-toggle="tooltip"]').tooltip('disable');
                }
            }

            var tooltipsEnabled = $('#toggleTooltips').is(':checked');
            $('[data-toggle="tooltip"]').tooltip();
            toggleTooltips(tooltipsEnabled);

            $('#toggleTooltips').change(function() {
                toggleTooltips(this.checked);
            });

            $('[data-toggle="tooltip"]').tooltip('dispose').tooltip();
        });
    </script>

</body>

</html>