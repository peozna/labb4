<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Labb 1a Sida 2</title>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
    <?php include 'menu.php'; ?>
    <h1>Labb 1a Sida 2</h1>
    <p>På denna sida kan du mata in tre olika sorters djur som du kan finna på en bondgård. Dessa kommer sparar i en array som kommer bli utskriven i råformat och sedan med några ändringar. </p>

    <!--Formulär för att ta emot tre djursorter -->
    <form action="sida2.php" method="POST">
        Djur 1: <input type="text" name="animal1"><br>
        Djur 2: <input type="text" name="animal2"><br>
        Djur 3: <input type="text" name="animal3"><br>
        <input type="submit" value="Spara">
    </form>
    <?php 
        /*Kollar att djuren är ifyllda i formuläret */
        if (isset($_POST["animal1"]) && isset($_POST["animal2"]) && isset($_POST["animal3"])) {
            /*Spara djuren i en array*/
            $farmAnimals = [
                htmlspecialchars($_POST["animal1"]),
                htmlspecialchars($_POST["animal2"]),
                htmlspecialchars($_POST["animal3"])
            ];    

            echo "<h3>Array i råformat</h3>";
            echo "<pre>";
            print_r($farmAnimals);      /*Skriver ut arrayen i råformat*/ 
            echo "</pre>";

            $farmAnimals[2]= "Struts"; /* Ändrar djuret på tredje plats till struts */
            
            $farmAnimals[] = "Alpacka"; /*Lägger till ett fjärde djur sist */
            
            array_shift($farmAnimals); /*Tar bort första djuret i arrayen */
        
            echo "<h3>Array efter ändringarna</h3>";
            echo "<pre>";
            print_r($farmAnimals); /* Skriver ut array efter ändringar */
            echo "</pre>";

            echo "<h3>Djuret på andra plats: </h3>";
            echo $farmAnimals[1]; /*Skriver ut djuret på andra plats */
        }
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>

</html>