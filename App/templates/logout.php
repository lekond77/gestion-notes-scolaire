<?php
    session_start(); // Démarre la session

    // Vérifie si l'utilisateur est connecté
    if (isset($_SESSION['user'])) {
        // Détruit la session en cours
        session_destroy();

        echo   'Vous avez été déconnecté. Rédirection.... ';
    } else {
        // Si l'utilisateur n'est pas connecté, redirige vers la page de connexion
        header('Location: index.php');
        exit();
    }