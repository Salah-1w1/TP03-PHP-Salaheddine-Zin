# TP 3 PHP - Suivi des notes des apprenants

- **Nom** : Zin
- **Prénom** : Salaheddine
- **Groupe** : G1
- **Module** : Programmation Web 2 - Année universitaire 2026/2027
- **Dépôt GitHub** : https://github.com/Salah-1w1/TP03-PHP-Salaheddine-Zin

## Lancer le projet

Ouvrir un terminal à la racine du projet, puis exécuter :

    & "C:\xampp\php\php.exe" -S localhost:8000

Il n'y a pas de page d'accueil : ouvrir directement une page, par exemple http://localhost:8000/exo1_bases.php

Arrêter le serveur avec Ctrl + C.

## Structure du projet

| Fichier | Rôle |
|---|---|
| config.php | Constantes de l'application |
| includes/ | Entête, menu et pied de page |
| data/ | Fichiers notes.csv et notes.json créés par les scripts |
| exo1_bases.php | Partie 1 : variables, constantes, types, chaînes |
| exo2_flux.php | Partie 2 : structures de contrôle et boucles |
| exo3_tableaux.php | Partie 3 : tableaux (avec includes, partie 4.1) |
| info.html / info.php | Partie 4.2 : formulaire GET |
| saisie.html / traitement.php | Parties 4.3 et 5.1 : formulaire POST et écriture CSV |
| liste.php | Parties 5.2 et 5.3 : lecture du CSV |
| export.php | Partie 5.4 : export JSON et serialize |
| login.php / profil.php / deconnexion.php | Partie 6.1 et 6.2 : sessions et cookies |
| dates.php | Partie 6.3 : dates |

## Réponses aux questions

### Partie 1

- **Constante non définie** : en PHP 8, l'afficher provoque une erreur fatale (`Undefined constant`) et le script s'arrête
- **const et define()** : `const` est résolu à la compilation et doit être écrit au niveau principal du fichier ; `define()` s'exécute à l'exécution, peut être appelé dans une condition et accepte un nom calculé
- **Noms de variables** : valides `$x`, `$_x`, `$Prix_HT`, `$état` ; invalides `$2x` (commence par un chiffre), `$x-y` (caractère `-`), `$prix ht` (espace)

### Partie 2

- **switch sans break** : PHP continue d'exécuter le `case` suivant (effet de chute) jusqu'à un `break` ou la fin du `switch`
- **while et do-while** : `while` teste la condition avant chaque itération (le corps peut ne jamais s'exécuter) ; `do-while` la teste après (le corps s'exécute au moins une fois)

### Partie 3

- **Tri d'un tableau indexé** : `sort()` (croissant) ou `rsort()` (décroissant), qui réindexent le tableau
- **Opérateurs de tableaux** : `$a + $b` donne `["x" => 1, "y" => 2]` (union) ; `$a == $b` vaut `true` (mêmes paires clé/valeur) ; `$a === $b` vaut `false` (l'ordre des clés diffère)

### Partie 4

- **include et require** : avec un fichier inexistant, `include` affiche un avertissement et le script continue ; `require` provoque une erreur fatale et le script s'arrête.
- **include et include_once** : `include` deux fois affiche le menu deux fois ; `include_once` ne l'inclut qu'une seule fois
- **GET** : les valeurs apparaissent dans l'URL (`info.php?nom=...&prenom=...&sexe=...`).
- **POST pour un mot de passe** : avec GET, la valeur est visible dans l'URL (historique, journaux, partage du lien) ; avec POST, elle est dans le corps de la requête.
- **$_REQUEST** : contient la fusion de `$_GET`, `$_POST` et `$_COOKIE` (selon la configuration `request_order`)

### Partie 5

- **Mode "w" au lieu de "a"** : `"w"` vide le fichier à chaque ouverture, on ne garderait que le dernier apprenant ; `"a"` ajoute à la fin
- **fgetcsv() ou fgets() + explode()** : `fgetcsv()` découpe directement la ligne et gère les guillemets et séparateurs, avec moins de code ; `fgets()` donne la ligne brute (plus de contrôle) mais demande plus de code et `explode()` se trompe si une valeur contient le séparateur
- **Format exploitable par JavaScript** : JSON (`JSON.parse()`) `serialize()` est un format propre à PHP

### Partie 6

- **Stockage** : la session est stockée côté serveur (le navigateur ne garde que l'identifiant `PHPSESSID`) ; le cookie est stocké côté client, dans le navigateur
- **setcookie() et header() avant tout affichage** : ils modifient les en-têtes HTTP, envoyés avant le corps de la page ; après un affichage, PHP signale `headers already sent`

## Résultats des tests

| Page | Test effectué | Résultat obtenu |
|---|---|---|
| exo1_bases.php | Ouverture de la page | Constantes, conversions, chaînes et prix TTC = 72 € |
| exo2_flux.php | Ouverture de la page | Mentions, mois courant, boucles et `break 2` corrects |
| exo3_tableaux.php | Ouverture de la page | Tableau des notes, somme 131, moyenne 11.91, tris et opérateurs |
| info.html / info.php | Envoi du formulaire GET | « Bonjour Monsieur Karim Alaoui » ; valeurs visibles dans l'URL |
| saisie.html / traitement.php | Saisie de 4 apprenants, puis une note 25 | Récapitulatif et ajout dans notes.csv ; erreur pour la note hors limites |
| liste.php | Ouverture de la page | Tableau Nom, Info, Math, Moyenne, Mention et moyenne générale |
| export.php | Ouverture de la page | notes.json écrit ; comparaison serialize / json_encode |
| login.php / profil.php / deconnexion.php | Parcours complet | Connexion, profil, déconnexion ; redirection si non connecté |
| dates.php | Ouverture et test de checkdate | Date du jour, jours restants, validation correcte |