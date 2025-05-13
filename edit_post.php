<?php 
include_once('db.php');
include('auth.php');

if(!isset($_GET['id'])) { 
    header('Location: dash.php');  //Om id inte är satt, omdirigerar till startsidan
    exit;
}
$post_id = $_GET['id']; // Hämtar inläggs-id 
$user_id = $_SESSION['user_id']; // Hämtar användar-idt från sessionen

//Hämta inlägget
$sql = "SELECT * FROM post WHERE id = ? AND userId = ?";
$statement = mysqli_prepare($connection, $sql); // Förbereder SQL-frågan
mysqli_stmt_bind_param($statement, 'ii', $post_id, $user_id); // Binder parametrarna till SQL-frågan
mysqli_stmt_execute($statement); // Utför SQL-frågan
$result = mysqli_stmt_get_result($statement); // Hämtar resultatet av SQL-frågan
$post = mysqli_fetch_assoc($result); // Hämtar inlägget som en associerad array
mysqli_stmt_close($statement); // Stänger statementet

//Om inlägget inte finns
if(!$post) {
    echo "h2>Inlägget finns inte.</h2>";
    exit;
}

//Om inlägget finns, skriv ut formuläret för att redigera inlägget
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? ''; // Hämtar titeln från formuläret
    $content = $_POST['content'] ?? ''; // Hämtar innehållet från formuläret

    $sql = "UPDATE post SET title = ?, content = ? WHERE id = ? AND userId = ?"; // SQL-fråga för att uppdatera inlägget
    $statement = mysqli_prepare($connection, $sql); // Förbereder SQL-frågan    
    mysqli_stmt_bind_param($statement, 'ssii', $title, $content, $post_id, $user_id); // Binder parametrarna till SQL-frågan
    mysqli_stmt_execute($statement); // Utför SQL-frågan
    mysqli_stmt_close($statement); // Stänger statementet
    header('Location: my_posts.php'); // Omdirigerar till sidan med användarens inlägg
    exit;
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Redigera inlägg</title>
    <link rel="stylesheet" href="style.css"> <!-- Länkar till CSS-filen för styling -->
</head>
<body>
    <h1>Redigera inlägg</h1>
    <form method="POST"> <!-- Formulär för att redigera inlägget -->
        <label for="title">Titel:</label><br>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>"><br><br> <!-- Förifylld titel -->
        <label for="content">Innehåll:</label><br>
        <textarea id="content" name="content" rows="8" cols="50"><?= htmlspecialchars($post['content']) ?></textarea><br><br> <!-- Förifyllt innehåll -->
        <input type="submit" value="Spara ändringar">
    </form>
    <a href="my_posts.php">Tillbaka till mina inlägg</a> <!-- Länk tillbaka till sidan med användarens inlägg -->