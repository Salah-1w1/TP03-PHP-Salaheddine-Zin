<?php
/*
 * Auteur : Salaheddine Zin
 * Objectif : Partie 0 et Partie 1 (variables, constantes, types et chaînes)
 * Date : 17/10/2026
 */

require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partie 1 - Bases de PHP</title>
</head>
<body>
    <h1>Partie 1 : variables, constantes, types et chaînes</h1>

    <h2>Partie 0 : Hello PHP et commentaires</h2>
    <?php echo 'Hello PHP'; ?>
    <?php
    // Commentaire sur une ligne avec //
    # Commentaire sur une ligne avec #
    /* Commentaire sur
       plusieurs lignes */
    ?>

    <h2>Exercice 1.1 : noms de variables</h2>
    <?php
    /*
     * $x        : valide (lettres autorisées)
     * $_x       : valide (le nom peut commencer par un underscore)
     * $2x       : INVALIDE (un nom ne peut pas commencer par un chiffre)
     * $x-y      : INVALIDE (le caractère - est interdit)
     * $Prix_HT  : valide (lettres, majuscules et underscore)
     * $prix ht  : INVALIDE (l'espace est interdit)
     * $état     : valide (PHP accepte les caractères accentués dans les noms)
     */
    $x = 1;
    $_x = 2;
    $Prix_HT = 100;
    $état = "valide";

    echo "<p>\$x = " . $x . "</p>";
    echo "<p>\$_x = " . $_x . "</p>";
    echo "<p>\$Prix_HT = " . $Prix_HT . "</p>";
    echo "<p>\$état = " . $état . "</p>";

    // PHP est sensible à la casse : $a et $A sont deux variables distinctes
    $a = "minuscule";
    $A = "majuscule";
    echo "<p>\$a = " . $a . "</p>";
    echo "<p>\$A = " . $A . "</p>";
    ?>

    <h2>Exercice 1.2 : constantes</h2>
    <?php
    echo "<p>ETABLISSEMENT = " . ETABLISSEMENT . "</p>";
    echo "<p>NOTE_MIN = " . NOTE_MIN . "</p>";
    echo "<p>NOTE_MAX = " . NOTE_MAX . "</p>";
    echo "<p>SEUIL = " . SEUIL . "</p>";
    ?>
    <pre>
<?php
    echo "defined('SEUIL') : ";
    var_dump(defined('SEUIL'));
    echo "defined('INCONNUE') : ";
    var_dump(defined('INCONNUE'));
?>
    </pre>
    <?php
    /*
     * Question 1 : que se passe-t-il si on affiche une constante non définie ?
     * Réponse : en PHP 8, cela lève une erreur fatale (Error : Undefined
     * constant) et le script s'arrête. (En PHP 7, c'était seulement un
     * avertissement et la constante était traitée comme une chaîne.)
     *
     * Question 2 : différence entre const et define() ?
     * Réponse : const est résolu à la compilation, doit être écrit au niveau
     * principal du fichier (pas dans un if, une boucle ou une fonction) et son
     * nom doit être un identifiant fixe. define() est exécuté à l'exécution,
     * peut être appelé dans une condition et accepte un nom calculé.
     */
    ?>

    <h2>Exercice 1.3 : calcul du prix TTC</h2>
    <?php
    $prix_ht = 60;
    $tva = 20;
    $prix_ttc = $prix_ht + ($prix_ht * $tva / 100);

    echo "<p>Le prix TTC du produit est de " . $prix_ttc . " €.</p>";
    ?>

    <h2>Exercice 1.4 : types et conversions</h2>
    <h3>1. Cast en string</h3>
    <pre>
<?php
    $test = 42;
    $test = (string) $test;
    var_dump($test);
?>
    </pre>

    <h3>2. Conversions en booléen</h3>
    <?php
    /*
     * Prédictions : 0 => false ; 0.0 => false ; "0" => false ; "" => false ;
     * "abc" => true ; [] => false ; null => false
     */
    ?>
    <pre>
<?php
    echo '(bool) 0 : ';      var_dump((bool) 0);
    echo '(bool) 0.0 : ';    var_dump((bool) 0.0);
    echo '(bool) "0" : ';    var_dump((bool) "0");
    echo '(bool) "" : ';     var_dump((bool) "");
    echo '(bool) "abc" : ';  var_dump((bool) "abc");
    echo '(bool) [] : ';     var_dump((bool) []);
    echo '(bool) null : ';   var_dump((bool) null);
?>
    </pre>

    <h3>3. Conversions numériques</h3>
    <?php
    /*
     * Prédictions : (int) 3.9 => 3 ; (int) "12abc" => 12 ;
     * (float) "1.5e3" => 1500 ; (int) true => 1
     */
    ?>
    <pre>
<?php
    echo '(int) 3.9 : ';        var_dump((int) 3.9);
    echo '(int) "12abc" : ';    var_dump((int) "12abc");
    echo '(float) "1.5e3" : ';  var_dump((float) "1.5e3");
    echo '(int) true : ';       var_dump((int) true);
?>
    </pre>

    <h3>4. Le nombre 255 en plusieurs notations</h3>
    <?php
    $decimal = 255;
    $hexadecimal = 0xFF;
    $octal = 0377;
    $binaire = 0b11111111;

    echo "<p>Décimal : " . $decimal . "</p>";
    echo "<p>Hexadécimal (0xFF) : " . $hexadecimal . "</p>";
    echo "<p>Octal (0377) : " . $octal . "</p>";
    echo "<p>Binaire (0b11111111) : " . $binaire . "</p>";
    ?>

    <h2>Exercice 1.5 : chaînes de caractères</h2>
    <?php
    $traitees = "égales à";
    $ici = 2;

    // 1. Guillemets doubles avec échappement des guillemets
    echo "<p>Ahmed a dit : \"J'ai réussi\"</p>";

    // 2. Guillemets simples : le \ suivi de * reste tel quel
    echo '<p>Voulez-vous supprimer C:\*.*?</p>';

    // 3. Guillemets simples : \n n'est pas interprété
    echo '<p>Ceci n\'affichera pas \n de nouvelle ligne</p>';

    // 4. Guillemets simples : les variables ne sont pas interprétées
    echo '<p>Les variables ne seront pas $traitees $ici</p>';

    // 5. Guillemets doubles : les variables sont interprétées
    echo "<p>Les variables seront $traitees $ici</p>";

    // trim() pour retirer les *
    $texte = trim("*Bonjour les développeurs*", "*");
    echo "<p>Après trim() : " . $texte . "</p>";
    ?>

    <h3>Une lettre par ligne (strlen et for)</h3>
    <?php
    // strlen() compte les octets : le é occupe 2 octets, donc il s'affiche mal
    for ($i = 0; $i < strlen($texte); $i++) {
        echo $texte[$i] . "<br>";
    }
    ?>

    <h3>Version corrigée pour les accents (mb_strlen et mb_substr)</h3>
    <?php
    for ($i = 0; $i < mb_strlen($texte); $i++) {
        echo mb_substr($texte, $i, 1) . "<br>";
    }
    ?>
</body>
</html>