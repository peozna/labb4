<?php 
    session_start(); // Startar sessionen
    include_once('db.php'); // Inkluderar databasanslutningen

    if (!isset($_SESSION['user_id'])) {
        // Kollar om användaren är inloggad, om inte, omdirigerar till login.php
        header('Location: login.php');
        exit();
    }
?>