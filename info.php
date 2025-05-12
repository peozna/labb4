<?php 
    include_once('db.php');

    if(isset($_GET['blogger'])) { //Kollar om det finns en blogger i URLen
        $blogger_id = intval($_GET['blogger']); //Hämtar idt från URLen och gör den till en integer
    } elseif(isset($_SESSION['userId'])){
        $blogger_id = $_SESSION['userId']; //Om det finns en inloggad användare, sätt idt till den inloggade användaren
    } else {
        $blogger_id = null; //Sätter idt till null om det inte finns någon blogger i URLen
    } 

    if($blogger_id) {
        $query = "SELECT id, username, presentation, image FROM user WHERE id = $blogger_id"; //Hämtar bloggaren med det angivna idt
    } else {
        $query = "SELECT id, username, presentation, image FROM user ORDER BY created DESC LIMIT 1"; //Hämtar den senaste bloggen 
    }
    $result = mysqli_query($connection, $query); //Utför SQL-frågan
    $row = mysqli_fetch_assoc($result); //Hämtar resultatet som en associativ array

    if(isset($_SESSION['userId']) && $_SESSION['userId'] == $row['id']) { //Om det finns en inloggad användare och den är samma som bloggaren
        echo "<h3>Din profil</h3>"; //Skriver ut rubriken
        echo "<p><a href='profile_pic.php'><button>Ändra profilbild</button></a></p>"; //Länk för att ändra profilbild
    }
?>