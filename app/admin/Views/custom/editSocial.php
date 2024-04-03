<?php $title = "Liens Réseaux Sociaux"; ?>

<div class="container mt-5">
    <h2>Gérer les Liens Réseaux Sociaux</h2>
    <form id="socialLinksForm" method="POST" action="index.php?controller=social&action=saveLinks">
        <!-- Facebook -->
        <div class="mb-3">
            <label for="facebookUrl" class="form-label">Facebook URL</label>
            <input type="url" class="form-control input-desktop-width" id="facebookUrl" name="facebook" placeholder="https://www.facebook.com/YourPage" value="<?= $socialLinks['facebook'] ?? '' ?>">
        </div>
        <!-- Instagram -->
        <div class="mb-3">
            <label for="instagramUrl" class="form-label">Instagram URL</label>
            <input type="url" class="form-control input-desktop-width" id="instagramUrl" name="instagram" placeholder="https://www.instagram.com/YourProfile" value="<?= $socialLinks['instagram'] ?? '' ?>">
        </div>
        <!-- Twitter -->
        <div class="mb-3">
            <label for="twitterUrl" class="form-label">Twitter URL</label>
            <input type="url" class="form-control input-desktop-width" id="twitterUrl" name="twitter" placeholder="https://twitter.com/YourProfile" value="<?= $socialLinks['twitter'] ?? '' ?>">
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder les liens</button>
    </form>
</div>