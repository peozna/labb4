<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
    <?php include 'menu.php'; ?>
    <h1>Labb 1a Sida 5</h1>
    <p>På denna sida används PHP servervariabel för att presentera information. </p>

    <?php 
        echo "Servernamn: " . $_SERVER['SERVER_NAME'] . "<br>";
        echo "Användarens IP-adress: " . $_SERVER['REMOTE_ADDR'] . "<br>";
        echo "Filnamnet: " . $_SERVER['PHP_SELF'] . "<br>";
        echo "Port: " . $_SERVER['REMOTE_PORT'] . "<br>";
        echo "Metod: " . $_SERVER['REQUEST_METHOD'] . "<br>";
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>