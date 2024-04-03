<?php
$title = "Sélectionner l'image de couverture";
?>

<style>
    .container {
        max-width: 1000px;
        margin: auto;
        padding: 20px;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 20px;
        /* Espace entre les éléments */
    }

    form div {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    form img {
        width: 300px;
        /* Largeur des images */
        height: auto;
        /* Hauteur automatique pour garder l'aspect ratio */
        padding: 10px;
        /* Padding autour des images */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        /* Ombre légère pour un effet subtil */
        border-radius: 8px;
        /* Bords arrondis */
    }

    form button[type="submit"] {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button[type="submit"]:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        form img {
            width: 100%;
            /* Permet aux images de s'adapter à la largeur de l'écran */
            max-width: 300px;
            /* Conserve une largeur maximale pour les écrans plus larges */
        }
    }
</style>


<div class="container mt-5">
    <h2>Sélectionnez l'image de couverture pour votre album</h2>
    <p>Veuillez choisir une image ci-dessous pour définir comme couverture de votre album.</p>

    <form action="index.php?controller=media&action=saveAlbum" method="post">


        <?php if (!empty($_SESSION['uploaded_media_paths'])) : ?>
            <?php foreach ($_SESSION['uploaded_media_paths'] as $index => $path) : ?>
                <div>
                    <input type="radio" id="cover<?= $index ?>" name="cover" value="<?= $path ?>">
                    <label for="cover<?= $index ?>">
                        <img src="../../app/public/<?= $path ?>" alt="Image <?= $index ?>" style="width: 300px;">
                    </label>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Sauvegarder l'album</button>
    </form>
</div>