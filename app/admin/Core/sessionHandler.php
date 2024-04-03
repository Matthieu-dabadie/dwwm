<?php


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 180)) {
    session_unset();
    session_destroy();
    header("Location: index.php?controller=login&action=index");
    exit;
}
$_SESSION['last_activity'] = time();
