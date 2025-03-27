<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
    <?php include 'menu.php'; ?>
    <h1>Labb 1a Sida 6</h1>
    <p>På denna sida kan du fylla i två formulär, dock bara ett åt gången.</p>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        $name = htmlspecialchars($_GET['name']);
        $phone = htmlspecialchars($_GET['phone']);

        echo "<h3>Formulärdata</h3>" . "<br>";
        echo "Namn: " . $name . "<br>";
        echo "Telefonnummer: " . $phone . "<br>";
    }
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $name = htmlspecialchars($_POST['name']);
        $phone = htmlspecialchars($_POST['phone']);

        echo "<h3>Formulärdata</h3>" . "<br>";
        echo "Namn: " . $name . "<br>";
        echo "Telefonnummer: " . $phone . "<br>";
    }
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>