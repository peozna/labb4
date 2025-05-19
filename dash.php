<?php
    include_once('db.php'); // Inkluderar databasanslutningen
    include('auth.php');
    include('header.php'); // Inkluderar headern
    
    if(!isset($_SESSION['username'])) { // Kollar om användaren är inloggad
        header('Location: index.php'); // Om inte, omdirigerar till startsidan
        exit(); // Avslutar skriptet
    }

    $userId = $_SESSION['user_id']; // Hämtar användar-id från sessionen
    $username = $_SESSION['username']; // Hämtar användarnamn från sessionen
    
?>

<!DOCTYPE html> 
<html lang="sv"> 
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Gör sidan responsiv -->
    <link rel="stylesheet" href="style.css"> 
    <title>Min blogg</title> 
</head>
<body>
    <div class ="layout">
        <div class="right">
        <h3>Min blogg</h3>
    <?php 
    $query = "SELECT username, presentation, image FROM user WHERE id = ?";
    $statement = $connection->prepare($query); // Förbereder SQL-frågan
    $statement->bind_param('i', $userId); // Binder parametrarna till SQL-frågan
    $statement->execute(); // Utför SQL-frågan
    $result = $statement->get_result(); // Hämtar resultatet av SQL-frågan
    if($row = $result->fetch_assoc()) {
        echo "<h4>" . htmlspecialchars($row['username']) . "</h4>"; // Skriver ut användarnamnet
        echo "<p>" . htmlspecialchars($row['presentation']) . "</p>"; // Skriver ut presentationen
        
        $image = isset($row['image']) && !empty($row['image']) ? $row['image'] : 'default.png';
        echo "<img src='uploads/" . htmlspecialchars($image) . "' alt='Profilbild' style='width:80px; height:80px; object-fit:cover; border-radius:50%;'>";

    } else {
        echo "<p>Ingen användare hittades.</p>"; // Skriver ut meddelande om ingen användare hittas
    } ?>

    <a href="account_manage.php"><button>Hantera mitt konto</button></a>
    </div>

    <div class="center">
    <div class="header_buttons">
            <a href="post.php"><button class="create_button">Skapa nytt inlägg</button></a>
        </div>
        <h3>Mina inlägg</h3>
        <?php
        $query = "SELECT * FROM post WHERE userId = ? ORDER BY created DESC"; //Hämtar alla inlägg tillhörande användaren
        $statement = $connection->prepare($query); // Förbereder SQL-frågan
        $statement->bind_param('i', $userId); // Binder parametrarna till SQL-frågan
        $statement->execute(); // Utför SQL-frågan
        $result = $statement->get_result(); // Hämtar resultatet av SQL-frågan

        if($result->num_rows > 0) { 
            while($post=$result->fetch_assoc()){
                echo "<h4>" . htmlspecialchars($post['title']) . "</h4>"; // Skriver ut titeln på inlägget
                echo "<p>" . nl2br(htmlspecialchars($post['content'])) . "</p>"; // Skriver ut innehållet i inlägget med radbrytningar
                
                //Knappar för att redigera och ta bort inlägg
                if(isset($_SESSION['user_id'])) {
                    echo "<a href='edit_post.php?id=" . $post['id'] . "'><button class='edit_button'>Redigera</button></a>"; // Länk för att redigera inlägget
                    echo "<a href='delete_post.php?id=" . $post['id'] . "' onclick=\"return confirm('Är du säker på att du vill ta bort inlägget?');\"><button class='remove_button'>Ta bort inlägg</button></a>"; // Länk för att ta bort inlägget med bekräftelse
                }
            }
            } else {
                echo "<p>Inga inlägg hittades.</p>"; // Skriver ut meddelande om inga inlägg hittas
            }
        ?>
    </div>
    </div>
<?php include('footer.php'); // Inkluderar footern ?>
</body>
</html>
