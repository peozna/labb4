<?php 
    include_once('db.php');

    $blogger_id = isset($_GET['blogger']) ? intval($_GET['blogger']) : null; //Hämtar idt från URLen och gör den till en integer
    if ($blogger_id) {
        $query = "SELECT username, presentation, image FROM user WHERE id = $blogger_id"; //Hämtar användaren med det angivna idt.
    } else {
        $query = "SELECT username, presentation, image FROM user ORDER BY created DESC LIMIT 1"; //Hämtar den senaste användaren
    }

    $result = mysqli_query($connection, $query); //Utför SQL frågan
    $row = mysqli_fetch_assoc($result); //Hämtar resultatet som en associativ array
    if ($row) {
        echo "<h3> Bloggaren: " . htmlspecialchars($row['username']) . "</h3>"; //Skriver ut användarnamnet
        echo "<p>" . nl2br(htmlspecialchars($row['presentation'])) . "</p>"; //Skriver ut presentationen
        if (!empty($row['image'])) { //Om det finns en bild, skriv ut den
            echo "<img src = 'img/" . htmlspecialchars($row['image']) . "' alt='Profilbild'>"; 
        }
    } else {
        echo "<h3>Det finns inga bloggare.</h3>"; //Om inga bloggare finns, skriv ut meddelande    }
    }
   
?>