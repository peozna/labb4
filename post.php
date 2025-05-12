<?php
    include_once('db.php'); // Inkluderar databasanslutningen
    include('auth.php'); // Inkluderar autentisering

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'] ?? ''; // Hämtar titeln från formuläret
        $content = $_POST['content'] ?? ''; // Hämtar innehållet från formuläret

        if (!empty($title) && !empty($content)) {
            add_post($title, $content, $_SESSION['user_id']); // Lägger till inlägget i databasen
            echo "<p>Inlägget har skapats!</p>"; // Skriver ut meddelande om att inlägget har skapats
        } else {
            echo "<p>Vänligen fyll i alla fält.</p>"; // Skriver ut meddelande om att alla fält måste fyllas i
        }       
    }
?>

<h2>Skapa nytt inlägg</h2>
<form method="POST"> <!-- Ett formulär för att skapa nytt inlägg -->
    <label for="title">Titel:</label><br>
    <input type="text" id="title" name="title"><br><br>
    <label for="content">Innehåll:</label><br>
    <textarea id="content" name="content" rows="8" cols="50"></textarea><br><br>
    <input type="submit" value="Skapa inlägg">
</form>
<a href="dash.php">Tillbaka till startsidan</a> <!-- Länk tillbaka till startsidan -->