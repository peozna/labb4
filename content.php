<?php 
include_once('db.php');

if (isset($_GET['blogger'])) { // Om det finns en bloggare i URLen
    $blogger_id = intval($_GET['blogger']); // Hämtar idt från URLen och gör det till en integer
    if (isset($_GET['post'])) {
        $post_id = intval($_GET['post']);
        // Hämtar det valda inlägget, och säkerställer att det tillhör rätt bloggare
        $query = "SELECT title, content, image_path FROM post WHERE id = ? AND userId = ?";
        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, 'ii', $post_id, $blogger_id);
    } else {
        // Hämtar senaste inlägget från den valda bloggaren
        $query = "SELECT title, content, image_path FROM post WHERE userId = ? ORDER BY created DESC LIMIT 1";
        $statement = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($statement, 'i', $blogger_id);
    }
} elseif (isset($_GET['post'])) {
    $post_id = intval($_GET['post']); // Hämtar idt från URLen och gör det till en integer
    $query = "SELECT title, content, image_path FROM post WHERE id = ?";
    $statement = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($statement, 'i', $post_id);
} else {
    $query = "SELECT title, content, image_path FROM post ORDER BY created DESC LIMIT 1";
    $statement = mysqli_prepare($connection, $query);
}

// Utför SQL-frågan
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

echo "<h1>Senaste inläggen</h1>"; // Skriver ut rubriken
if ($row = mysqli_fetch_assoc($result)) {
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>"; // Skriver ut titeln på inlägget
    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>"; // Skriver ut innehållet i inlägget med radbrytningar
    if (!empty($row['image_path'])) {
        echo "<img src='uploads/" . htmlspecialchars($row['image_path']) . "' alt='Bild till inlägg' style='max-width:100%; height:auto; margin-top:10px;'><br>";
    } // Om det finns en bild, skriv ut den
} else {
    echo "<p>Det finns inga inlägg</p>"; // Om inga inlägg finns, skriv ut meddelande
}
?>