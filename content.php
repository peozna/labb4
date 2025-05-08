<?php 
    include_once('db.php');

    if(isset($_GET['post'])) {
        $post_id = intval($_GET['post']); //Hämtar idt från URLen och gör det till en integer
        $query = "SELECT title, content FROM post WHERE id = $post_id"; //Hämtar inlägget med det angivna idt.
    } else {
        $query = "SELECT title, content FROM post ORDER BY created DESC LIMIT 1"; //Hämtar det senaste inlägget
    }

    $result = mysqli_query($connection, $query); //Utför SQL frågan
    if (!$result) {
        die("Query failed: " . mysqli_error($connection)); //Om frågan misslyckas, skriv ut felmeddelande
    }

    $row = mysqli_fetch_assoc($result); //Hämntar resultatet som en associativ array
    if ($row) {
        echo "<h2>" . htmlspecialchars($row['title']) . "</h2>"; //Skriver ut titeln på inlägget
        echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>"; //Skriver ut innehållet i inlägget med radbrytningar
    } else {
        echo "<h2>Det finns inga inlägg.</h2>"; //Om inga inlägg finns, skriv ut meddelande"
    }

?>