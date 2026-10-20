<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercices 4.3 et 5.1, traitement du formulaire POST
 *            et ajout des données valides dans data/notes.csv
 * Date : 20/10/2026
 */

require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 4.3 - Traitement POST</title>
</head>
<body>
    <h1>Exercice 4.3 : traitement du formulaire POST</h1>

    <?php
    // 1. Vérification de la présence des champs (évite "Undefined array key")
    if (!isset($_POST["nom"], $_POST["note_info"], $_POST["note_math"])) {
        echo "<p>Aucune donnée reçue. Veuillez d'abord remplir le formulaire.</p>";
    } else {
        $nom = trim($_POST["nom"]);
        $noteInfo = trim($_POST["note_info"]);
        $noteMath = trim($_POST["note_math"]);

        // 2. Champs vides (on n'utilise pas empty() seul car empty("0") vaut true)
        if ($nom === "" || $noteInfo === "" || $noteMath === "") {
            echo "<p>Erreur : tous les champs sont obligatoires.</p>";
        } elseif (!is_numeric($noteInfo) || !is_numeric($noteMath)) {
            echo "<p>Erreur : les notes doivent être des nombres.</p>";
        } else {
            $noteInfo = (float) $noteInfo;
            $noteMath = (float) $noteMath;

            // 3. Notes comprises entre NOTE_MIN et NOTE_MAX
            if ($noteInfo < NOTE_MIN || $noteInfo > NOTE_MAX
                || $noteMath < NOTE_MIN || $noteMath > NOTE_MAX) {
                echo "<p>Erreur : les notes doivent être comprises entre "
                    . NOTE_MIN . " et " . NOTE_MAX . ".</p>";
            } else {
                // 4. Récapitulatif protégé par htmlspecialchars()
                $nomSafe = htmlspecialchars($nom, ENT_QUOTES, 'UTF-8');
                $moyenne = ($noteInfo + $noteMath) / 2;

                echo "<h2>Récapitulatif</h2>";
                echo "<ul>";
                echo "<li>Nom : " . $nomSafe . "</li>";
                echo "<li>Note Info : " . $noteInfo . "</li>";
                echo "<li>Note Math : " . $noteMath . "</li>";
                echo "<li>Moyenne : " . round($moyenne, 2) . "</li>";
                echo "</ul>";

                // 5. Exercice 5.1 : ajout dans data/notes.csv
                $fichier = fopen("data/notes.csv", "a");
                if ($fichier === false) {
                    echo "<p>Erreur : impossible d'ouvrir le fichier CSV.</p>";
                } else {
                    fputcsv($fichier, [$nom, $noteInfo, $noteMath], ";");
                    fclose($fichier);
                    echo "<p>Enregistrement ajouté dans data/notes.csv.</p>";
                }
            }
        }
    }

    /*
     * Question 5.1 : que se passerait-il avec le mode "w" au lieu de "a" ?
     * Réponse : "w" ouvre le fichier en écriture et le VIDE à chaque ouverture :
     * on ne garderait que le dernier apprenant saisi "a" ajoute à la fin
     *
     * Question 4.3 : pourquoi préférer POST à GET pour un mot de passe ?
     * Réponse : avec GET, les valeurs apparaissent dans l'URL (historique,
     * journaux du serveur, partage du lien) Avec POST, elles sont dans le
     * corps de la requête
     *
     * Question 4.3 : que contient $_REQUEST ?
     * Réponse : la fusion de $_GET, $_POST et $_COOKIE (selon la
     * configuration request_order de PHP)
     */
    ?>

    <p><a href="saisie.html">Nouvelle saisie</a></p>
    <p><a href="liste.php">Voir la liste</a></p>
</body>
</html>