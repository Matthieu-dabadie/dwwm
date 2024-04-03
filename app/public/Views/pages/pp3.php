<?php
$title = htmlspecialchars($pageData['slug']);
?>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .albums-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .album {
            width: 300px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
            cursor: pointer;
        }

        .cover img,
        .cover video {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }


        .modal-xl {
            max-width: 800px;
        }

        /* Styles spécifiques pour le conteneur du carrousel */
        .carousel-item {
            display: none;
            justify-content: center;
            align-items: center;
            height: 450px;
        }

        .carousel-item.active {
            display: flex;
        }

        .carousel-item img,
        .carousel-item video {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        /* Styles pour les boutons de contrôle du carrousel */
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-image: none !important;
        }

        .carousel-control-prev-icon:after,
        .carousel-control-next-icon:after {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            background: no-repeat center center;
            background-size: 100% 100%;
        }

        /* Utiliser une icône de flèche personnalisée pour le bouton précédent */
        .carousel-control-prev-icon:after {
            background-image: url('data:image/svg+xml;charset=UTF8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M5.5 0l-5 4 5 4V5H8V3H5.5V0z"/></svg>');
        }

        /* Utiliser une icône de flèche personnalisée pour le bouton suivant */
        .carousel-control-next-icon:after {
            background-image: url('data:image/svg+xml;charset=UTF8,<svg xmlns="http://www.w3.org/2000/svg" fill="%23000" viewBox="0 0 8 8"><path d="M2.5 0v3H0v2h2.5v3l5-4-5-4z"/></svg>');
        }
    </style>
</head>

<div class="container mt-5">
    <div class="albums-container">
        <?php foreach ($albums as $albumId => $album) : ?>
            <div class="album" data-album-id="<?= $albumId ?>">
                <div class="cover">
                    <h5><?= htmlspecialchars($album['title']) ?></h5>

                    <?php
                    if (strpos($album['cover_media_path'], '.mp4') !== false) : ?>
                        <video controls style="width: 100%; height: 300px; object-fit: cover;">
                            <source src="<?= htmlspecialchars($album['cover_media_path']) ?>" type="video/mp4">
                        </video>
                    <?php else : ?>
                        <img src="<?= htmlspecialchars($album['cover_media_path']) ?>" alt="Couverture de l'album" style="width: 100%; height: 300px; object-fit: cover;">
                    <?php endif; ?>
                </div>
                <div class="media-thumbnails">
                    <?php
                    $firstThreeMedia = array_slice($album['media'], 0, 3);
                    foreach ($firstThreeMedia as $mediaPath) :
                        if (strpos($mediaPath, '.mp4') !== false) : ?>
                            <video controls style="width: 92px; height: 92px; object-fit: cover;">
                                <source src="<?= htmlspecialchars($mediaPath) ?>" type="video/mp4">
                            </video>
                        <?php else : ?>
                            <img src="<?= htmlspecialchars($mediaPath) ?>" alt="Miniature" style="width: 92px; height: 92px; object-fit: cover;">
                    <?php endif;
                    endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>







<!-- Modal Diaporama -->
<div class="modal fade" id="diaporamaModal" tabindex="-1" aria-labelledby="diaporamaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diaporamaModalLabel">Diaporama</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- carrousel injecté ici -->
            </div>
        </div>
    </div>
</div>




<script>
    var albums = <?php echo json_encode(array_values($albums)); ?>;
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Convertir les données PHP des albums en JSON pour utilisation dans JavaScript
        var albums = <?php echo json_encode($albums); ?>;

        document.querySelectorAll('.album').forEach(function(albumElement) {
            albumElement.addEventListener('click', function() {
                var albumId = this.getAttribute('data-album-id');
                var album = albums[albumId];

                if (album) {
                    // Initialiser le contenu du carrousel
                    var carouselContent = '<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';

                    album.media.forEach(function(mediaPath, index) {
                        var itemClass = index === 0 ? "carousel-item active" : "carousel-item";
                        if (mediaPath.endsWith('.mp4')) {
                            // Si le chemin de média est une vidéo
                            carouselContent += '<div class="' + itemClass + '"><video controls class="d-block w-100"><source src="' + mediaPath + '" type="video/mp4"></video></div>';
                        } else {
                            // Si le chemin de média est une image
                            carouselContent += '<div class="' + itemClass + '"><img src="' + mediaPath + '" class="d-block w-100"></div>';
                        }
                    });

                    carouselContent += '</div><a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div>';

                    // Injecter le contenu du carrousel dans la modale et l'afficher
                    document.querySelector('#diaporamaModal .modal-body').innerHTML = ''; // Vide le contenu précédent
                    document.querySelector('#diaporamaModal .modal-body').innerHTML = carouselContent; // Injecte le nouveau contenu
                    $('#diaporamaModal').modal('show');
                }
            });
        });
    });
</script>