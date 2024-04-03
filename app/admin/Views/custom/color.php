<?php $title = "Gestion des couleurs"; ?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Paramètres des couleurs</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="?controller=home&action=updateColors" id="colorForm">
                        <!-- Existing fields for text and background -->
                        <div class="mb-3">
                            <label for="textColor" class="form-label">Couleur du texte :</label>
                            <input type="color" class="form-control form-control-color" id="textColor" name="text_color" value="<?= htmlspecialchars($colors['text_color']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="backgroundColor" class="form-label">Couleur de fond :</label>
                            <input type="color" class="form-control form-control-color" id="backgroundColor" name="background_color" value="<?= htmlspecialchars($colors['background_color']) ?>">
                        </div>
                        <!-- Footer colors -->
                        <hr>
                        <h5 class="mb-3">Pied de page</h5>
                        <div class="mb-3">
                            <label for="footerColor1" class="form-label">Couleur 1 du pied de page :</label>
                            <input type="color" class="form-control form-control-color" id="footerColor1" name="footer_color_1" value="<?= htmlspecialchars($colors['footer_color_1']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="footerColor2" class="form-label">Couleur 2 du pied de page :</label>
                            <input type="color" class="form-control form-control-color" id="footerColor2" name="footer_color_2" value="<?= htmlspecialchars($colors['footer_color_2']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="footerTextColor" class="form-label">Couleur du texte du pied de page :</label>
                            <input type="color" class="form-control form-control-color" id="footerTextColor" name="footer_text_color" value="<?= htmlspecialchars($colors['footer_text_color']) ?>">
                        </div>
                        <!-- Navbar colors -->
                        <hr>
                        <h5 class="mb-3">Navbars</h5>
                        <div class="mb-3">
                            <label for="NavbarTextColor" class="form-label">Couleur du texte de la navbar principale :</label>
                            <input type="color" class="form-control form-control-color" id="primaryNavbarTextColor" name="primary_navbar_text_color" value="<?= htmlspecialchars($colors['primary_navbar_text_color']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="primaryNavbarBackgroundColor" class="form-label">Couleur de fond de la navbar principale :</label>
                            <input type="color" class="form-control form-control-color" id="primaryNavbarBackgroundColor" name="primary_navbar_background_color" value="<?= htmlspecialchars($colors['primary_navbar_background_color']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="secondaryNavbarTextColor" class="form-label">Couleur du texte de la navbar secondaire :</label>
                            <input type="color" class="form-control form-control-color" id="secondaryNavbarTextColor" name="secondary_navbar_text_color" value="<?= htmlspecialchars($colors['secondary_navbar_text_color']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="secondaryNavbarBackgroundColor" class="form-label">Couleur de fond de la navbar secondaire :</label>
                            <input type="color" class="form-control form-control-color" id="secondaryNavbarBackgroundColor" name="secondary_navbar_background_color" value="<?= htmlspecialchars($colors['secondary_navbar_background_color']) ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <iframe src="/app/public/index.php" style="width: 100%; height: 650px; border: none;" id="sitePreview"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/app/admin/assets/spectrum-master/spectrum.js"></script>
<link rel="stylesheet" href="/app/admin/assets/spectrum-master/spectrum.css">

<script>
    $(document).ready(function() {
        // Initialisation de Spectrum pour les champs de couleur
        $('#textColor, #backgroundColor, #navbarTextColor, #navbarBackgroundColor, #footerColor1, #footerColor2, #footerTextColor, #primaryNavbarTextColor, #primaryNavbarBackgroundColor, #secondaryNavbarTextColor, #secondaryNavbarBackgroundColor').spectrum({
            preferredFormat: "hex",
            showInput: true,
            showPalette: true,
            palette: [],
            change: function(color) {
                applyPreviewColors();
            }
        });

        // Fonction pour appliquer les couleurs choisies
        function applyPreviewColors() {
            var textColor = $('#textColor').spectrum('get').toString();
            var backgroundColor = $('#backgroundColor').spectrum('get').toString();
            var primaryNavbarTextColor = $('#primaryNavbarTextColor').spectrum('get').toString();
            var primaryNavbarBackgroundColor = $('#primaryNavbarBackgroundColor').spectrum('get').toString();

            // var primaryNavbarTextColor = $('#primaryNavbarTextColor').spectrum('get').toString();
            // var primaryNavbarBackgroundColor = $('#primaryNavbarBackgroundColor').spectrum('get').toString();
            var secondaryNavbarTextColor = $('#secondaryNavbarTextColor').spectrum('get').toString();
            var secondaryNavbarBackgroundColor = $('#secondaryNavbarBackgroundColor').spectrum('get').toString();
            var footerColor1 = $('#footerColor1').spectrum('get').toString();
            var footerColor2 = $('#footerColor2').spectrum('get').toString();
            var footerTextColor = $('#footerTextColor').spectrum('get').toString();

            var css = `
    body { color: ${textColor}; background-color: ${backgroundColor}; }
    #primaryNavbar, #primaryNavbar .navbar-brand, #primaryNavbar .nav-link { color: ${primaryNavbarTextColor} !important; background-color: ${primaryNavbarBackgroundColor} !important; }
    #secondaryNavbar, #secondaryNavbar .nav-link, #secondaryNavbar .navbar-brand { color: ${secondaryNavbarTextColor} !important; background-color: ${secondaryNavbarBackgroundColor} !important; }
    #footerUpper { background-color: ${footerColor1}; color: ${footerTextColor}; }
    #footerUpper .footer-link { color: ${footerTextColor}; }
    #footerLower { background-color: ${footerColor2}; color: ${footerTextColor}; }
`;


            var iframe = document.getElementById('sitePreview');
            var iframedoc = iframe.contentDocument || iframe.contentWindow.document;

            var styleTag = iframedoc.createElement('style');
            styleTag.type = 'text/css';
            if (styleTag.styleSheet) {
                styleTag.styleSheet.cssText = css;
            } else {
                styleTag.appendChild(iframedoc.createTextNode(css));
            }
            iframedoc.head.appendChild(styleTag);
        }

    });
</script>