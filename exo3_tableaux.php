<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Partie 3 (tableaux) avec interface factorisée (Partie 4.1)
 * Date : 18/10/2026
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

// Exercice 3.4 : fonction d'affichage factorisée
function afficher($tab)
{
    echo "<ul>";
    foreach ($tab as $nom => $note) {
        echo "<li>" . $nom . " : " . $note . "</li>";
    }
    echo "</ul>";
}

// Exercice 3.1 : création des tableaux
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];
$modules = ["Programmation Web", "Bases de données", "Algorithmique"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partie 3 - Tableaux</title>
</head>
<body>
    <?php include 'includes/entete_inc.php'; ?>
    <?php include 'includes/menu_inc.php'; ?>

    <h1>Partie 3 : tableaux</h1>

    <h2>Exercice 3.1 : création</h2>
    <h3>Modules avec foreach</h3>
    <ul>
        <?php foreach ($modules as $module): ?>
            <li><?= $module ?></li>
        <?php endforeach; ?>
    </ul>
    <h3>Modules par indice</h3>
    <ul>
        <?php for ($i = 0; $i < count($modules); $i++): ?>
            <li>modules[<?= $i ?>] = <?= $modules[$i] ?></li>
        <?php endfor; ?>
    </ul>

    <h2>Exercice 3.2 : affichage HTML</h2>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr><th>Nom</th><th>Note</th><th>Mention</th></tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $nom => $note): ?>
                <?php $style = ($note < SEUIL) ? ' style="color: red;"' : ''; ?>
                <tr<?= $style ?>>
                    <td><?= $nom ?></td>
                    <td><?= $note ?></td>
                    <td><?= mention($note) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Exercice 3.3 : statistiques</h2>
    <?php
    // 1. Calcul avec une boucle (sans array_sum)
    $somme = 0;
    $nb = 0;
    $meilleure = null;
    $faible = null;
    foreach ($notes as $note) {
        $somme += $note;
        $nb++;
        if ($meilleure === null || $note > $meilleure) {
            $meilleure = $note;
        }
        if ($faible === null || $note < $faible) {
            $faible = $note;
        }
    }
    $moyenne = $somme / $nb;
    ?>
    <h3>Calcul avec une boucle</h3>
    <ul>
        <li>Somme : <?= $somme ?></li>
        <li>Moyenne : <?= round($moyenne, 2) ?></li>
        <li>Meilleure note : <?= $meilleure ?></li>
        <li>Plus faible note : <?= $faible ?></li>
    </ul>

    <h3>Vérification avec array_sum, count, max et min</h3>
    <ul>
        <li>Somme : <?= array_sum($notes) ?></li>
        <li>Moyenne : <?= round(array_sum($notes) / count($notes), 2) ?></li>
        <li>Meilleure note : <?= max($notes) ?></li>
        <li>Plus faible note : <?= min($notes) ?></li>
    </ul>

    <h3>Effectifs par mention</h3>
    <?php
    $effectifs = [];
    foreach ($notes as $note) {
        $m = mention($note);
        if (!isset($effectifs[$m])) {
            $effectifs[$m] = 0;
        }
        $effectifs[$m]++;
    }
    ?>
    <ul>
        <?php foreach ($effectifs as $m => $effectif): ?>
            <li><?= $m ?> : <?= $effectif ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Exercice 3.4 : tri</h2>
    <?php
    ksort($notes);
    echo "<h3>Par noms croissants (ksort)</h3>";
    afficher($notes);

    arsort($notes);
    echo "<h3>Par notes décroissantes (arsort)</h3>";
    afficher($notes);

    krsort($notes);
    echo "<h3>Par noms décroissants (krsort)</h3>";
    afficher($notes);

    asort($notes);
    echo "<h3>Par notes croissantes (asort)</h3>";
    afficher($notes);

    /*
     * Question : quelle fonction de tri pour un tableau indexé comme $modules ?
     * Réponse : sort() (ordre croissant) ou rsort() (ordre décroissant),
     * car elles trient les valeurs et réindexent le tableau (0, 1, 2...).
     */
    ?>

    <h2>Exercice 3.5 : opérateurs de tableaux</h2>
    <?php
    $a = ["x" => 1, "y" => 2];
    $b = ["y" => 2, "x" => 1];
    ?>
    <pre>
<?php
    echo '$a + $b : ';
    print_r($a + $b);
    echo '$a == $b : ';
    var_dump($a == $b);
    echo '$a === $b : ';
    var_dump($a === $b);
?>
    </pre>
    <?php
    /*
     * $a + $b (union) : garde les clés de $a, puis ajoute celles de $b
     * qui n'existent pas déjà. Résultat : ["x" => 1, "y" => 2].
     * $a == $b : true (mêmes paires clé/valeur, quel que soit l'ordre).
     * $a === $b : false (=== exige aussi le même ordre).
     */
    ?>

    <?php include 'includes/pied_inc.php'; ?>
</body>
</html>