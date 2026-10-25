<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercice 6.3, dates (date, DateTime, diff, checkdate)
 * Date : 25/10/2026
 */

require 'config.php';

// 6.3.2 : jours restants avant la fin du semestre
$aujourdhui = new DateTime("today");
$finSemestre = new DateTime("2027-01-31");
$difference = $aujourdhui->diff($finSemestre);
$joursRestants = (int) $difference->format("%r%a");

// 6.3.3 : validation d'une date saisie avec checkdate()
$messageDate = "";
if (isset($_GET["jour"], $_GET["mois"], $_GET["annee"])
    && $_GET["jour"] !== "" && $_GET["mois"] !== "" && $_GET["annee"] !== "") {
    $jour = (int) $_GET["jour"];
    $mois = (int) $_GET["mois"];
    $annee = (int) $_GET["annee"];

    if (checkdate($mois, $jour, $annee)) {
        $messageDate = "La date " . sprintf("%02d/%02d/%04d", $jour, $mois, $annee) . " est valide.";
    } else {
        $messageDate = "La date " . sprintf("%02d/%02d/%04d", $jour, $mois, $annee) . " est invalide.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 6.3 - Dates</title>
</head>
<body>
    <h1>Exercice 6.3 : dates</h1>

    <h2>6.3.1 : date du jour (date())</h2>
    <p>Aujourd'hui : <?= date("d/m/Y") ?></p>

    <h2>6.3.2 : jours restants avant la fin du semestre (DateTime et diff)</h2>
    <p>Date de fin de semestre : 31/01/2027</p>
    <p>Nombre de jours restants : <strong><?= $joursRestants ?></strong></p>

    <h2>6.3.3 : validation d'une date (checkdate)</h2>
    <form action="dates.php" method="get">
        <label for="jour">Jour :</label>
        <input type="number" id="jour" name="jour" min="1" max="31">
        <label for="mois">Mois :</label>
        <input type="number" id="mois" name="mois" min="1" max="12">
        <label for="annee">Année :</label>
        <input type="number" id="annee" name="annee">
        <button type="submit">Valider</button>
    </form>

    <?php if ($messageDate !== ""): ?>
        <p><strong><?= htmlspecialchars($messageDate, ENT_QUOTES, 'UTF-8') ?></strong></p>
    <?php endif; ?>

    <p><a href="liste.php">Voir la liste</a></p>
</body>
</html>