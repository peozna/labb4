
<?php
    include_once('db.php'); // Inkluderar databasanslutningen
    include('auth.php');
    session_start(); // Startar sessionen
    
?>

<h2>Välkommen, <?php echo $_SESSION['username'];?></h2>

<ul> <!-- Skapar en lista med länkar till olika sidor -->
    <li><a href ="post.php">Skapa nytt inlägg</a></li>
    <li><a href ="my_posts.php">Hantera mina inlägg</a></li>
    <li><a href ="profile_pic.php">Ändra profilbild</a></li>
    <li><a href ="logout.php">Logga ut</a></li>
</ul>