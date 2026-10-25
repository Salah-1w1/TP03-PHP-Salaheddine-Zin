<?php
session_start();
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercices 6.1 et 6.2, connexion avec session et cookie
 * Date : 25/10/2026
 */

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = isset($_POST["login"]) ? trim($_POST["login"]) : "";

    if ($login === "") {
        $erreur = "Le login est obligatoire.";
    } else {
        // Exercice 6.1 : enregistrement du login dans la session
        $_SESSION["login"] = $login;

        // Exercice 6.2 : cookie valable 24 heures
        setcookie("dernier_login", $login, time() + 86400, "/");

        // Variante : un seul cookie avec login + date de connexion (JSON)
        $infos = ["login" => $login, "date" => date("d/m/Y H:i:s")];
        setcookie("infos_connexion", json_encode($infos), time() + 86400, "/");

        // Redirection vers le profil
        header("Location: profil.php");
        exit;
    }
}

// Exercice 6.2 : pré-remplissage du champ avec le cookie s'il existe
$loginPrerempli = "";
if (isset($_COOKIE["dernier_login"])) {
    $loginPrerempli = $_COOKIE["dernier_login"];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if ($erreur !== ""): ?>
        <p style="color: red;"><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form action="login.php" method="post">
        <p>
            <label for="login">Login :</label>
            <input type="text" id="login" name="login"
                   value="<?= htmlspecialchars($loginPrerempli, ENT_QUOTES, 'UTF-8') ?>">
        </p>
        <p><button type="submit">Se connecter</button></p>
    </form>

    <?php
    /*
     * Question : où est stockée une session ? où est stocké un cookie ?
     * Réponse : la session est stockée côté serveur (le navigateur ne garde
     * que l'identifiant PHPSESSID). Le cookie est stocké côté client,
     * dans le navigateur.
     *
     * Question : pourquoi setcookie() et header() avant tout affichage ?
     * Réponse : ils modifient les en-têtes HTTP, qui sont envoyés avant le
     * corps de la page. Dès que du contenu est affiché, les en-têtes sont
     * déjà partis : PHP lève l'erreur "headers already sent".
     */
    ?>
</body>
</html>