<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap CSS (version 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- favicon -->
    <link rel="icon" href="<?= htmlspecialchars($faviconPath); ?>">

    <link rel="stylesheet" href="assets/CSS/style.css">
    <script src="assets/js/background.js"></script>
    <script src="/app/admin/assets/js/alertDashbord.js" defer></script>
    <style>
        body {
            color: <?= htmlspecialchars($colors['text_color']); ?>;
            background-color: <?= htmlspecialchars($colors['background_color']); ?>;
            <?php if ($backgroundData['container_type'] == 'container-fluid' && !empty($backgroundData['image_path']) && $backgroundData['image_path'] !== 'no-image.jpeg') : ?>background: url('/app/public/assets/images/background/<?= $backgroundData['image_path']; ?>') no-repeat center center / cover;
            <?php endif; ?>
        }

        #primaryNavbar,
        .navbar-primary {
            background-color: <?= htmlspecialchars($colors['primary_navbar_background_color']); ?> !important;
        }

        #primaryNavbar .nav-link,
        #primaryNavbar .navbar-brand,
        .navbar-primary .nav-link,
        .navbar-primary .navbar-brand {
            color: <?= htmlspecialchars($colors['primary_navbar_text_color']); ?> !important;
        }

        #secondaryNavbar,
        .navbar-secondary {
            background-color: <?= htmlspecialchars($colors['secondary_navbar_background_color']); ?> !important;
        }

        #secondaryNavbar .nav-link,
        #secondaryNavbar .navbar-brand,
        .navbar-secondary .nav-link,
        .navbar-secondary .navbar-brand {
            color: <?= htmlspecialchars($colors['secondary_navbar_text_color']); ?> !important;
        }

        #footerUpper {
            background-color: <?= htmlspecialchars($colors['footer_color_1']); ?>;
        }

        #footerLower,
        #customFooter .footer-text {
            background-color: <?= htmlspecialchars($colors['footer_color_2']); ?>;
            color: <?= htmlspecialchars($colors['footer_text_color']); ?>;
        }

        #customFooter .footer-link {
            color: <?= htmlspecialchars($colors['footer_text_color']); ?>;
        }
    </style>

</head>

<body>


    <div id="cookieConsentContainer" class="cookie-consent-container" style="display: none; position: fixed; bottom: 0; width: 100%; background: rgba(0,0,0,0.8); color: white; text-align: center; padding: 10px; z-index: 1000;">
        <p>Ce site utilise des cookies pour améliorer votre expérience. En continuant à utiliser ce site, vous acceptez notre <a href="#" style="color: #ffa500;">politique de cookies</a>. <button id="acceptCookieConsent" class="btn btn-primary btn-sm">J'accepte</button></p>
    </div>


    <div class="container p-0 <?php echo ($backgroundData['container_type'] == 'container' && !empty($backgroundData['image_path']) && $backgroundData['image_path']
                                    !== 'no-image.jpeg') ? 'background-container' : ''; ?>" <?php if (
                                                                                                $backgroundData['container_type'] == 'container' &&
                                                                                                !empty($backgroundData['image_path']) && $backgroundData['image_path'] !== 'no-image.jpeg'
                                                                                            ) : ?> style="background: url('/app/public/assets/images/background/<?= $backgroundData['image_path']; ?>') no-repeat center center / cover;" <?php endif; ?>>


        <!-- Menu nav haut de page -->
        <?php require_once("navbar.php"); ?>

        <!-- Bandeau image -->
        <div class="container p-0">
            <?php if (!empty($bannerPath)) : ?>
                <img src="<?= htmlspecialchars($bannerPath); ?>" alt="Bandeau" width="100%" height="auto">
            <?php else : ?>
                <img src="/app/public/assets/images/bandeau.png" alt="bandeau" width="100%" height="auto">
            <?php endif; ?>
        </div>

        <!-- Menu générale -->
        <?php require_once("header.php"); ?>

        <!-- alert mail -->
        <?php if (isset($_SESSION['email_sent'])) : ?>
            <div class='alert alert-success' role='alert'>
                <?= $_SESSION['email_sent'] ?>
            </div>
            <?php unset($_SESSION['email_sent']); ?>
        <?php endif; ?>

        <!-- fin alert mail -->

        <main>

            <?= $content; ?>

        </main>

        <?php require_once("footer.php"); ?>

    </div>


    <!-- Bootstrap Bundle JS (inclut Popper) (version 5) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- jQuery (version complète) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var cookieConsent = getCookie("user_cookie_consent");
            if (cookieConsent != "1") {
                document.getElementById("cookieConsentContainer").style.display = "block";
            }

            document.getElementById("acceptCookieConsent").onclick = function() {
                setCookie("user_cookie_consent", "1", 365);
                document.getElementById("cookieConsentContainer").style.display = "none";
            };

            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            function getCookie(name) {
                var nameEQ = name + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }
        });
    </script>

</body>

</html>