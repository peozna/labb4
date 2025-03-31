<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Labb 1a Sida6</title>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
    <?php include 'menu.php'; ?>
    <h1>Labb 1a Sida 6</h1>
    <p>På denna sida kan du fylla i två formulär, dock bara ett åt gången.</p>

    <?php
    /*Kollar om formuläret skickats med GET metod */
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        /*Tar emot namn och telnr*/
        $name = htmlspecialchars($_GET['name']);
        $phone = htmlspecialchars($_GET['phone']);

        /*Skriver ut formulärdata */
        echo "<h3>Formulärdata</h3>" . "<br>";
        echo "Namn: " . $name . "<br>";
        echo "Telefonnummer: " . $phone . "<br>";
    }
    /*Kollar om formuläret skickats med POST metod */
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        /*Tar emot namn och telnr*/
        $name = htmlspecialchars($_POST['name']);
        $phone = htmlspecialchars($_POST['phone']);

        /*Skriver ut formulärdata */
        echo "<h3>Formulärdata</h3>" . "<br>";
        echo "Namn: " . $name . "<br>";
        echo "Telefonnummer: " . $phone . "<br>";
    }
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>
</html>