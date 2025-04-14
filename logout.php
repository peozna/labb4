<?php 
session_start(); 
session_unset(); 
session_destroy(); // Avsluta sessionen och ta bort alla sessionvariabler
header("Location: login.php"); // Skicka användaren till inloggningssidan
exit; // Avsluta skriptet
?>