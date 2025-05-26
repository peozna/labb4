<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<header>
<link rel="stylesheet" href="style.css">
<h1> Välkommen till bloggportalen! </h1>

<div class="header_buttons">
    <?php 
        if(isset($_SESSION['username'])) { ?> <!-- Om användaren är inloggad -->
        <span>Inloggad som: <?php echo htmlspecialchars($_SESSION['username']); ?></span>
            <a href="dash.php" class="button" style="margin-left:10px;">Min blogg</a>
            <a href="index.php" class="button" style="margin-left:10px;">Startsida</a>
        <a href='logout.php' class="button">
            Logga ut
        </a> <!-- Knapp för att logga ut -->
    <?php } else { ?> <!-- Om användaren inte är inloggad -->
        <a href="login.php" class="button">
        Logga in
    </a> <!-- Knapp för att logga in -->
    <a href="register.php" class="button">
       Registrera dig
    </a> <!-- Knapp för att registrera sig -->
    <?php } ?>
</div>

</header>
