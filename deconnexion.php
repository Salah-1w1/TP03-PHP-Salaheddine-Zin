<?php
session_start();
/*
 * Auteur : Salaheddine Zin
 * Objectif : Exercice 6.1, déconnexion (destruction de la session)
 * Date : 25/10/2026
 */

// Vider les variables de session
session_unset();

// Détruire la session
session_destroy();

// Redirection vers la page de connexion
header("Location: login.php");
exit;