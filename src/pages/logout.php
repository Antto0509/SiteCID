<?php
// Démarre la session
session_start();

// Détruit toutes les variables de session
$_SESSION = array();

// Supprime le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Détruis la session
session_destroy();

// Redirige vers l'accueil
header("Location: ../index.php");
exit();