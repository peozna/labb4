<?php 
    include_once('db.php');
    include('auth.php');


    $user_id = $_SESSION['user_id']; // Hämtar användar-idt från sessionen
    $sql = "SELECT * FROM post WHERE userId = ?"; // Hämtar alla inlägg som tillhör den inloggade användaren
    $statement = mysqli_prepare($connection, $sql); // Förbereder SQL-frågan
    mysqli_stmt_bind_param($statement, 'i', $user_id); 
    mysqli_stmt_execute($statement); // Utför SQL-frågan
    $result = mysqli_stmt_get_result($statement); // Hämtar resultatet av SQL-frågan
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Mina inlägg</title>
    <link rel="stylesheet" href="style.css"> <!-- Länkar till CSS-filen för styling -->
</head>

<body>
    <div class="my_posts">
    <h3>Min blogg</h3>
    <h1>Mina inlägg</h1>
    <a href="post.php">Skapa nytt inlägg</a> <!-- Länk för att skapa nytt inlägg -->
    <a href="dash.php">Tillbaka till startsidan</a> <!-- Länk tillbaka till startsidan -->

<?php while($row = mysqli_fetch_assoc($result)) { ?> <!-- Loopar igenom alla inlägg som tillhör den inloggade användaren -->
    <div class="post">
        <h2><?=htmlspecialchars($row['title']) ?></h2> <!-- Skriver ut titeln på inlägget -->
        <p><?=nl2br(htmlspecialchars($row['content'])) ?></p> <!-- Skriver ut innehållet i inlägget med radbrytningar -->)
        <small>Publicerat: <?=$row['created'] ?></small> <!-- Skriver ut när inlägget publicerades -->
        <a href="edit_post.php?post=<?=$row['id'] ?>">Redigera</a> <!-- Länk för att redigera inlägget -->
        <a href="delete_post.php?id=<?= $row['id'] ?>"
        onclick="return confirm('Är du säker på att du vill ta bort inlägget?');">
        Ta bort inlägg</a> 
    </div>
</div>
    <hr>
<?php } ?> <!-- Avslutar while-loopen -->
</body>
</html>