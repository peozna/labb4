<?php 
include_once('db.php'); 
session_start(); // Startar sessionen
include('auth.php');

if(!isset($_GET['id'])) { // Kollar om id är satt i URL:en
    header('Location: my_posts.php'); // Om inte, omdirigerar till mina inlägg
    exit();
}

$post_id = $_GET['id']; // Hämtar inläggs-id från URL:en
$user_id = $_SESSION['user_id']; // Hämtar användar-id från sessionen

$sql = "DELETE FROM post WHERE id = ? AND userId = ?"; // SQL-fråga för att ta bort inlägget
$statement = mysqli_prepare($connection, $sql); // Förbereder SQL-frågan
mysqli_stmt_bind_param($statement, 'ii', $post_id, $user_id); // Binder parametrarna till SQL-frågan
mysqli_stmt_execute($statement); // Utför SQL-frågan
mysqli_stmt_close($statement); // Stänger statementet

header('Location: my_posts.php'); // Omdirigerar till sidan med användarens inlägg
exit(); // Avslutar skriptet
?>