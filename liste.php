<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercices 5.2 et 5.3, lecture de data/notes.csv
 *            (fgetcsv puis fgets/explode)
 * Date : 20/10/2026
 */

require 'config.php';

// Fonction mention() (même logique que dans exo2_flux.php)
function mention($note)
{
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    } else {
        return "Ajourné";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 5.2 - Liste des notes</title>
</head>
<body>
    <h1>Exercice 5.2 : liste des notes (fgetcsv)</h1>

    <?php
    $chemin = "data/notes.csv";

    // 1. Test de l'existence du fichier
    if (!file_exists($chemin)) {
        echo "<p>Erreur : le fichier $chemin n'existe pas. Saisissez d'abord des notes.</p>";
        echo '<p><a href="saisie.html">Aller à la saisie</a></p>';
        exit;
    }

    // 2. Ouverture en lecture avec gestion de l'échec
    $fichier = fopen($chemin, "r");
    if ($fichier === false) {
        echo "<p>Erreur : impossible d'ouvrir le fichier $chemin.</p>";
        exit;
    }
    ?>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Info</th>
                <th>Math</th>
                <th>Moyenne</th>
                <th>Mention</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sommeMoyennes = 0;
            $nbApprenants = 0;

            // 3. Lecture ligne par ligne avec fgetcsv()
            while (($ligne = fgetcsv($fichier, 1000, ";")) !== false) {
                // Ignorer les lignes vides ou incomplètes
                if (count($ligne) < 3) {
                    continue;
                }

                $nom = htmlspecialchars($ligne[0], ENT_QUOTES, 'UTF-8');
                $info = (float) $ligne[1];
                $math = (float) $ligne[2];
                $moyenne = ($info + $math) / 2;

                $sommeMoyennes += $moyenne;
                $nbApprenants++;

                // 4. Affichage d'une ligne du tableau
                echo "<tr>";
                echo "<td>" . $nom . "</td>";
                echo "<td>" . $info . "</td>";
                echo "<td>" . $math . "</td>";
                echo "<td>" . round($moyenne, 2) . "</td>";
                echo "<td>" . mention($moyenne) . "</td>";
                echo "</tr>";
            }
            fclose($fichier);
            ?>
        </tbody>
    </table>

    <?php
    // 5. Moyenne générale de la classe
    if ($nbApprenants > 0) {
        $moyenneGenerale = $sommeMoyennes / $nbApprenants;
        echo "<p><strong>Moyenne générale de la classe : " . round($moyenneGenerale, 2) . "</strong></p>";
    } else {
        echo "<p>Aucun apprenant enregistré.</p>";
    }
    ?>

    <h1>Exercice 5.3 : lecture « bas niveau » (fgets, feof, explode)</h1>
    <ul>
        <?php
        $fichier = fopen($chemin, "r");
        if ($fichier !== false) {
            while (!feof($fichier)) {
                $ligne = fgets($fichier);
                if ($ligne === false || trim($ligne) === "") {
                    continue;
                }
                $champs = explode(';', trim($ligne));
                echo "<li>" . htmlspecialchars(implode(" | ", $champs), ENT_QUOTES, 'UTF-8') . "</li>";
            }
            fclose($fichier);
        }
        ?>
    </ul>

    <?php
    /*
     * Comparaison fgetcsv() / fgets() + explode() :
     * - fgetcsv() : découpe directement la ligne en tableau, gère les
     *   guillemets et les séparateurs présents dans les valeurs. Plus sûr,
     *   moins de code. Inconvénient : moins de contrôle sur la ligne brute.
     * - fgets() + feof() + explode() : on récupère la ligne brute, donc plus
     *   de contrôle et utile pour tout fichier texte. Inconvénient : plus de
     *   code, et explode() se trompe si une valeur contient le séparateur
     *   (ou des guillemets) ; il faut aussi gérer soi-même les lignes vides
     *   et le saut de ligne final.
     */
    ?>

    <p><a href="saisie.html">Nouvelle saisie</a></p>
</body>
</html>