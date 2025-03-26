<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head>   
<body>
    <h1> Labb 1a Sida 1</h1>
    <p>Denna sida..</p>
    <?php 
        echo 'Denna text är genererad med utskriftskommandot i PHP';
    ?>
    <form action="" method="POST">
        Namn: <input type="text" name="name"><br>
        <input type="submit">
    </form> 
    <?php
    if (isset($_POST["name"]) && !empty($_POST["name"])) { /*if sats som kollar att namn är ifyllt*/
        $strName = htmlspecialchars($_POST["name"]);
        echo "Hej " . $strName . "<br>";
        echo "Baklänges: " . strrev($strName) . "<br>";
        echo "Gemener: " . strtolower($strName) . "<br>";
        echo "Versaler: " . strtoupper($strName) . "<br>";
        echo "Antal tecken: " . strlen($strName) . "<br>";
    } /*Utskrifter som sker efter att namn skickats in i formuläret*/
    ?>
    <?php 
        include 'footer.php';
    ?> 
</body>
</html>