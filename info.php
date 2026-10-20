<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercice 4.2, traitement du formulaire GET (info.html)
 * Date : 20/10/2026
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 4.2 - Traitement GET</title>
</head>
<body>
    <h1>Exercice 4.2 : traitement du formulaire GET</h1>

    <?php
    // Vérification de la présence des champs (évite "Undefined array key")
    if (!isset($_GET["nom"], $_GET["prenom"], $_GET["sexe"])) {
        echo "<p>Aucune donnée reçue. Veuillez d'abord remplir le formulaire.</p>";
    } else {
        $nom = trim($_GET["nom"]);
        $prenom = trim($_GET["prenom"]);
        $sexe = $_GET["sexe"];

        if ($nom === "" || $prenom === "") {
            echo "<p>Formulaire incomplet : le nom et le prénom sont obligatoires.</p>";
        } else {
            // Choix de la civilité selon le sexe
            if ($sexe === "F") {
                $civilite = "Madame";
            } else {
                $civilite = "Monsieur";
            }

            // Échappement avant affichage
            $nomSafe = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
            $prenomSafe = htmlspecialchars($prenom, ENT_QUOTES, 'UTF-8');

            echo "<p>Bonjour " . $civilite . " " . $prenomSafe . " " . $nomSafe . "</p>";
        }
    }
    ?>

    <p><a href="info.html">Retour au formulaire</a></p>
</body>
</html>