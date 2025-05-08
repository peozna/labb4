<?php 
    include_once('db.php'); 
    $query = "SELECT * FROM user"; // Hämtar alla användare från databasen
    $result = mysqli_query($connection, $query); //Utför SQL-frågan

    echo "<ul>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li><a href='index.php?blogger'=" . $row['id'] . ">" . 
            htmlspecialchars($row['username']) . "</a></li>";
        } // Loopar igenom alla användare och skrivver ut dem i en lista
    echo "</ul>";

?>