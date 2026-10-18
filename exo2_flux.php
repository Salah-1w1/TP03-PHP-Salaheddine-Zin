<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Partie 2 (structures de contrôle et boucles)
 * Date : 18/10/2026
 */

require 'config.php';

// Exercice 2.1 : fonction mention()
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
    <title>Partie 2 - Structures de contrôle</title>
</head>
<body>
    <h1>Partie 2 : structures de contrôle et boucles</h1>

    <h2>Exercice 2.1 : if / elseif / else</h2>
    <?php
    $notesTest = [18, 16, 15, 14, 12, 10, 9, 0];
    foreach ($notesTest as $n) {
        echo "<p>Note " . $n . " : " . mention($n) . "</p>";
    }
    ?>

    <h2>Exercice 2.2 : switch</h2>
    <?php
    $mois = date("m");

    switch ($mois) {
        case "01":
            $nomMois = "Janvier";
            break;
        case "02":
            $nomMois = "Février";
            break;
        case "03":
            $nomMois = "Mars";
            break;
        case "04":
            $nomMois = "Avril";
            break;
        case "05":
            $nomMois = "Mai";
            break;
        case "06":
            $nomMois = "Juin";
            break;
        case "07":
            $nomMois = "Juillet";
            break;
        case "08":
            $nomMois = "Août";
            break;
        case "09":
            $nomMois = "Septembre";
            break;
        case "10":
            $nomMois = "Octobre";
            break;
        case "11":
            $nomMois = "Novembre";
            break;
        case "12":
            $nomMois = "Décembre";
            break;
        default:
            $nomMois = "Mois inconnu";
            break;
    }
    echo "<p>Mois courant : " . $mois . " (" . $nomMois . ")</p>";

    /*
     * Question : que se passe-t-il si on oublie un break dans un case ?
     * Réponse : PHP continue d'exécuter les instructions du case suivant
     * (effet de "chute" ou fall-through), jusqu'à rencontrer un break
     * ou la fin du switch. Le nom du mois affiché serait alors faux.
     */
    ?>

    <h2>Exercice 2.3 : boucles</h2>

    <h3>1. Triangle d'étoiles</h3>
    <pre>
<?php
    for ($ligne = 1; $ligne <= 6; $ligne++) {
        for ($etoile = 1; $etoile <= $ligne; $etoile++) {
            echo "*";
        }
        echo "\n";
    }
?>
    </pre>

    <h3>2. while : nombres de 0 à 20 par pas de 2</h3>
    <?php
    $i = 0;
    while ($i <= 20) {
        if ($i == 10) {
            echo "<strong>" . $i . "</strong> ";
        } else {
            echo $i . " ";
        }
        $i += 2;
    }
    ?>

    <h3>3. for et continue : nombres pairs de 0 à 10</h3>
    <?php
    for ($i = 0; $i <= 10; $i++) {
        if ($i % 2 != 0) {
            continue;
        }
        echo $i . " ";
    }
    ?>

    <h3>4. while, switch et break 2</h3>
    <?php
    $i = 1;
    while (true) {
        switch ($i) {
            case 5:
                echo "<p>At 5</p>";
                break;      // sort uniquement du switch
            case 10:
                echo "<p>At 10; quitting</p>";
                break 2;    // sort du switch ET de la boucle
        }
        $i++;
    }
    ?>

    <h3>5. do-while : nombres de 0 à 20 par pas de 2</h3>
    <?php
    $i = 0;
    do {
        if ($i == 10) {
            echo "<strong>" . $i . "</strong> ";
        } else {
            echo $i . " ";
        }
        $i += 2;
    } while ($i <= 20);

    /*
     * Différence essentielle : while teste la condition AVANT chaque
     * itération (le corps peut ne jamais s'exécuter), alors que do-while
     * teste la condition APRÈS : le corps s'exécute toujours au moins une fois.
     */
    ?>
</body>
</html>