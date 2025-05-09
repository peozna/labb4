<?php 
    session_start(); // Startar sessionen
    include_once('db.php'); // Inkluderar databasanslutningen

    $username = $_POST['username']; // Hämtar användarnamn från formuläret
    $password = $_POST['password']; // Hämtar lösenord från formuläret

    $user = get_user($username); // Hämtar användaren från databasen med det angivna användarnamnet
    if ($user && password_verify($password, $user[0]['password'])) { // Om användaren finns och lösenordet stämmer
        $_SESSION['username'] = $username; // Sätter sessionens användarnamn till det inloggade användarnamnet
        $_SESSION['user_id'] = $user[0]['id']; // Sätter sessionens användar-id till det inloggade användar-id:t
        header('Location: index.php'); // Omdirigerar till index.php
        exit(); // Avslutar skriptet
    } else {
        echo "Felaktigt användarnamn eller lösenord"; // Skriver ut felmeddelande om inloggningen misslyckas

    }
?>