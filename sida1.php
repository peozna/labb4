<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Labb 1a Sida 1</title>
    <link rel="stylesheet" href="mystyle.css">
</head>   
<body>
    <?php include 'menu.php'; ?>
    <h1> Labb 1a Sida 1</h1>
    <p>På denna sida kan du spara ditt namn och få utsrkivet på olika sätt.</p>
    <!--Exempel på text som är PHP genererad -->
    <?php 
        echo 'Denna text är genererad med utskriftskommandot i PHP';
    ?>
    <!--Formulär för att ta emot användarens namn -->
    <form action="sida1.php" method="POST">
        Namn: <input type="text" name="name"><br>
        <input type="submit" value="Spara">
    </form> 
    <!--PHP kod som hanterar formulärinskicket -->
    <?php
    if (isset($_POST["name"]) && !empty($_POST["name"])) { /*if sats som kollar att namn är ifyllt*/
        $strName = htmlspecialchars($_POST["name"]);
        /*Utskrifter som sker efter att namn skickats in i formuläret*/
        echo "Hej " . $strName . "<br>";
        echo "Baklänges: " . strrev($strName) . "<br>";
        echo "Gemener: " . strtolower($strName) . "<br>";
        echo "Versaler: " . strtoupper($strName) . "<br>";
        echo "Antal tecken: " . strlen($strName) . "<br>";
    } 
    ?>
    <?php 
        include 'footer.php';
    ?> 
</body>
</html>