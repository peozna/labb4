<?php 
    include_once('db.php'); 
    
    if(isset($_GET['blogger'])) { // Kollar om blogger är satt i URL:en
        $blogger_id = intval($_GET['blogger']); // Hämtar idt från URLen och gör det till en integer
        $userQuery = "SELECT username, presentation, image FROM user WHERE id = $blogger_id"; // Hämtar användaren med det angivna idt.
        $userResult = mysqli_query($connection, $userQuery); // Utför SQL-frågan
        $userRow = mysqli_fetch_assoc($userResult); // Hämtar resultatet som en associativ array

        if ($userRow) {
            echo "<h3> Bloggaren: " . htmlspecialchars($userRow['username']) . "</3>"; //Skriver ut användarnamnet
            //Hämtar alla inlägg från den valda bloggaren
            $postQuery = "SELECT title, content FROM post WHERE userId = $blogger_id ORDER BY created DESC";
            $postResult = mysqli_query($connection, $postQuery); // Utför SQL-frågan

            echo "<ul>";
            //Loopar igenom alla inlägg som tilhör den valda bloggaren
            while ($postRow = mysqli_fetch_assoc($postResult)) {
                echo "<li><a href='index.php?blogger=$blogger_id&$post=" . $postRow['id'] . "'>" . 
                     htmlspecialchars($postRow['title']) . "</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<h3>Det finns inga bloggare.</h3>"; // Om inga bloggare finns, skriv ut meddelande
        } 
         // Länk tillbaka till startsidan
    echo "<p><a href='index.php'>Tillbaka till startsidan</a></p>";
    } else {
        //Om ingen bloggare är vald, visa de nyaste bloggarna
        echo "<h3>Nyaste bloggarna</h3>"; 

        $query = "SELECT * FROM user"; // Hämtar alla användare från databasen
        $result = mysqli_query($connection, $query); //Utför SQL-frågan

        echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href='index.php?blogger=" . $row['id'] . "'>" . 
            htmlspecialchars($row['username']) . "</a></li>";
        }
        echo "</ul>";
}

?>