<?php 
session_start(); // Startar sessionen
session_unset(); // Rensar sessionens variabler
$_SESSION = array(); // Rensar sessionens variabler
session_destroy(); // Avslutar sessionen
header('Location: index.php'); // Omdirigerar till startsidan
exit();
?>