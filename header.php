<?php 
    session_start();
?>

<header>
<link rel="stylesheet" href="style.css">
<h1> Välkommen till bloggportalen! </h1>

<div class="header_buttons">
    <?php 
        if(isset($_SESSION['username'])) { ?> <!-- Om användaren är inloggad -->
        <a href='logout.php'>
            <button>Logga ut</button>
        </a> <!-- Knapp för att logga ut -->
    <?php } else { ?> <!-- Om användaren inte är inloggad -->
        <a href="login.php">
        <button>Logga in</button>
    </a> <!-- Knapp för att logga in -->
    <a href="register.php">
       <button>Registrera dig</button>
    </a> <!-- Knapp för att registrera sig -->
    <?php } ?>
</div>

</header>