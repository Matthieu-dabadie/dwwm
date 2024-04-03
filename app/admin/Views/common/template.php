<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title ?></title>
    <!-- Inclure font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Inclure jQuery + bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclure summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">

    <!-- Inclure Spectrum Colorpicker -->
    <link rel="stylesheet" type="text/css" href="/app/admin/assets/spectrum-master/spectrum.css">
    <script type="text/javascript" src="/app/admin/assets/spectrum-master/spectrum.js" defer></script>
    <!-- Inclure JS perso -->
    <script src="/app/admin/assets/js/media.dashboard.js" defer></script>
    <script src="/app/admin/assets/js/editBanner.js" defer></script>
    <script src="/app/admin/assets/js/alertDashbord.js" defer></script>
    <!-- Inclure CSS perso -->
    <link rel="stylesheet" href="/app/admin/assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <?php ini_set('display_errors', 1);
        error_reporting(E_ALL); ?>
        <?php require_once("header.php"); ?>


        <main>

            <?= $content; ?>

        </main>


        <?php require_once("footer.php"); ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>