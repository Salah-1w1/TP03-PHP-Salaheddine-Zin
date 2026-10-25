<?php
session_start();
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercice 6.1, page de profil protégée par la session
 * Date : 25/10/2026
 */

// Si l'utilisateur n'est pas connecté, redirection vers la connexion
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$login = htmlspecialchars($_SESSION["login"], ENT_QUOTES, 'UTF-8');

// Variante cookie : relecture du cookie JSON (login + date de connexion)
$infos = null;
if (isset($_COOKIE["infos_connexion"])) {
    $infos = json_decode($_COOKIE["infos_connexion"], true);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
</head>
<body>
    <h1>Profil</h1>

    <p>Bienvenue, <strong><?= $login ?></strong> !</p>

    <?php if (is_array($infos) && isset($infos["date"])): ?>
        <p>Connexion enregistrée le : <?= htmlspecialchars($infos["date"], ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <p><a href="deconnexion.php">Se déconnecter</a></p>
    <p><a href="liste.php">Voir la liste des notes</a></p>
</body>
</html>