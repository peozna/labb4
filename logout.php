<?php 
session_start(); // Startar sessionen
$_SESSION = array(); // Rensar sessionens variabler
session_destroy(); // Avslutar sessionen
header('Location: index.php'); // Omdirigerar till startsidan
?>