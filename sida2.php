<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
    <h1>Labb 1a Sida 2</h1>
    <p>Denna sida..</p>

    <form action="" method="POST">
        Djur 1: <input type="text" name="animal1"><br>
        Djur 2: <input type="text" name="animal2"><br>
        Djur 3: <input type="text" name="animal3"><br>
        <input type="submit" value="Skicka">
    </form>
    <?php 
        if (isset($_POST["animal1"]) && isset($_POST["animal2"]) && isset($_POST["animal3"])) {
            /*Spara djuren i en array*/
            $farmAnimals = [
                htmlspecialchars($_POST["animal1"]),
                htmlspecialchars($_POST["animal2"]),
                htmlspecialchars($_POST["animal3"])
            ];    

            echo "<h2>De inmatade djuren</h2>";
            echo "<pre";
            print_r($farmAnimals);
            echo "</pre>";
        }
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>

</html>