<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head>

<body>
    <h1>Labb 1a Sida 3</h1>
    <p> På denna..</p>
    
    <form action="" method="POST">
        Text: <input type="text" name="word"><br>
        Sökord: <input type="text" name="searchWord"><br>
        <input type="submit" value="Spara">
    </form>

    <?php 
        if (isset($_POST["word"]) && !empty($_POST["word"])) {
            /*Ta emot text*/
            $strText = htmlspecialchars($_POST["word"]);

            /*Sätta orden i en array */
            $wordsArray = explode (" ", $strText); 

            /*Skriver ut arrayen */
            echo "<h3>Array i råformat</h3>";
            echo "<pre>";
            print_r($wordsArray);
            echo "</pre>";
        }
        if (isset($_POST["searchWord"]) && !empty($_POST["searchWord"])) {
            /*Ta emot sökordet */
            $strSearchWord = htmlspecialchars($_POST["searchWord"]);

            /*Söka efter sökordet i arrayen */
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
            echo "<h3>Sökresultat</h3>";
            echo "<p>Sökordet '$strSearchWord' hittades inte i texten</p>"; 
        }
    
    ?>

    <?php 
        include 'footer.php';
    ?>
</body>