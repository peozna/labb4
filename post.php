<?php
    include_once('db.php'); // Inkluderar databasanslutningen
    include('auth.php'); // Inkluderar autentisering

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'] ?? ''; // Hämtar titeln från formuläret
        $content = $_POST['content'] ?? ''; // Hämtar innehållet från formuläret
        $image_path = ''; // Initierar variabel för bildväg

        if(!empty($_FILES['image']['name'])) { // Om en bild har laddats upp
            $target_dir = "uploads/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // Skapar mappen om den inte finns
            }
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Hämtar filtypen
        
            $check = getimagesize($_FILES["image"]["tmp_name"]); // Kontrollerar om filen är en bild
            if($check !==false) {
                if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) { // Flyttar den uppladdade filen till rätt mapp
                    $image_path = htmlspecialchars(basename($_FILES["image"]["name"])); // Sparar bildvägen
                } else {
                    echo "<p>Tyvärr, det gick inte att ladda upp bilden.</p>"; // Skriver ut meddelande om uppladdningen misslyckades
                }
            }
        }

        if (!empty($title) && !empty($content)) {
            add_post($title, $content, $_SESSION['user_id'], $image_path); // Lägger till inlägget i databasen
            echo "<p>Inlägget har skapats!</p>"; // Skriver ut meddelande om att inlägget har skapats
        } else {
            echo "<p>Vänligen fyll i alla fält.</p>"; // Skriver ut meddelande om att alla fält måste fyllas i
        }       
    }
?>

<h2>Skapa nytt inlägg</h2>
<form method="POST" enctype="multipart/form-data"> <!-- Ett formulär för att skapa nytt inlägg -->
    <label for="title">Titel:</label><br>
    <input type="text" id="title" name="title"><br><br>
    <label for="content">Innehåll:</label><br>
    <textarea id="content" name="content" rows="8" cols="50"></textarea><br><br>
    <label for="image">Lägg till bild</label><br>
    <input type="file" id="image" name="image"><br><br> 
    <input type="submit" value="Skapa inlägg">
</form>
<a href="dash.php">Tillbaka till startsidan</a> <!-- Länk tillbaka till startsidan -->