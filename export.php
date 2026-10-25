<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercice 5.4, export JSON des résultats et comparaison
 *            avec serialize()
 * Date : 20/10/2026
 */

require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 5.4 - Sérialisation</title>
</head>
<body>
    <h1>Exercice 5.4 : sérialisation (JSON et serialize)</h1>

    <?php
    $chemin = "data/notes.csv";

    if (!file_exists($chemin)) {
        echo "<p>Erreur : le fichier $chemin n'existe pas. Saisissez d'abord des notes.</p>";
        echo '<p><a href="saisie.html">Aller à la saisie</a></p>';
        exit;
    }

    // 1. Construction du tableau associatif des résultats
    $resultats = [];
    $fichier = fopen($chemin, "r");
    if ($fichier === false) {
        echo "<p>Erreur : impossible d'ouvrir le fichier $chemin.</p>";
        exit;
    }
    while (($ligne = fgetcsv($fichier, 1000, ";")) !== false) {
        if (count($ligne) < 3) {
            continue;
        }
        $info = (float) $ligne[1];
        $math = (float) $ligne[2];
        $resultats[] = [
            "nom" => $ligne[0],
            "info" => $info,
            "math" => $math,
            "moyenne" => round(($info + $math) / 2, 2)
        ];
    }
    fclose($fichier);

    // 2. Écriture dans data/notes.json
    $json = json_encode($resultats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents("data/notes.json", $json);
    echo "<p>Fichier data/notes.json écrit (" . count($resultats) . " apprenants).</p>";

    // 3. Relecture et affichage avec print_r()
    $relu = json_decode(file_get_contents("data/notes.json"), true);
    ?>
    <h2>Relecture avec json_decode() et print_r()</h2>
    <pre><?php print_r($relu); ?></pre>

    <h2>4. Comparaison : serialize() et json_encode()</h2>
    <h3>serialize()</h3>
    <pre><?= htmlspecialchars(serialize($resultats), ENT_QUOTES, 'UTF-8') ?></pre>
    <h3>json_encode()</h3>
    <pre><?= htmlspecialchars(json_encode($resultats, JSON_UNESCAPED_UNICODE), ENT_QUOTES, 'UTF-8') ?></pre>

    <?php
    /*
     * Question : quel format est directement exploitable par JavaScript ?
     * Réponse : JSON. JavaScript le lit avec JSON.parse() (ou fetch().json()).
     * serialize() produit un format propre à PHP, que JavaScript ne comprend pas.
     */
    ?>

    <p><a href="liste.php">Voir la liste</a></p>
</body>
</html>