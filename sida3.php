<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Labb 1a Sida 3</title>
    <link rel="stylesheet" href="mystyle.css">
</head>

<body>
    <?php include 'menu.php'; ?>
    <h1>Labb 1a Sida 3</h1>
    <p> På denna sida kan du skriva in en text och ett sökord. Textens ord sparas i en array och med en loop kommer sökordet att letas efter i texten.</p>
    
    <!--Formulär som tar emot text och sökord -->
    <form action="sida3.php" method="POST">
        Text: <input type="text" name="word"><br>
        Sökord: <input type="text" name="searchWord"><br>
        <input type="submit" value="Spara">
    </form>

    <?php 
        /*Kollar att text är ifylld i formuläret */
        if (isset($_POST["word"]) && !empty($_POST["word"])) {
            $strText = htmlspecialchars($_POST["word"]);

            /*Sätter in orden i en array */
            $wordsArray = explode (" ", $strText); 

            /*Skriver ut arrayen */
            echo "<h3>Array i råformat</h3>";
            echo "<pre>";
            print_r($wordsArray);
            echo "</pre>";
        }


        /*Initierar sökord variabeln */
        $strSearchWord = "";

        /*Kollar att sökord är ifyllt i formuläret */
        if (isset($_POST["searchWord"]) && !empty($_POST["searchWord"])) {
            $strSearchWord = htmlspecialchars($_POST["searchWord"]);

            /*Loopar i arrayen efter sökordet*/
            $positions = [];
            foreach ($wordsArray as $index => $word) {
                if ($word == $strSearchWord) {
                    $positions[] = $index; /*Spara position */
                }
            }
        }
        /*Skriver ut reslutat */
        if (!empty($positions)) {
            $count = count($positions); /*Räknar hur många gånger sökordet använts */
            echo "<h3>Sökresultat</h3>";
            echo "Sökordet '$strSearchWord' hittades på följande position/er: " 
            . implode(", ", $positions) . "<br>";
            echo "Sökordet '$strSearchWord' hittades $count gång/er i texten";
        } else {
            if(!empty($strText) && !empty($strSearchWord)) {
            echo "<h3>Sökresultat</h3>";
            echo "<p>Sökordet '$strSearchWord' hittades inte i texten</p>"; 
            }
        }
    
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>