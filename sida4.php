<!DOCTYPE html>
<html lang="sv">
<head>
    <title>Lab 1a Sida 4</title>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
<?php include 'menu.php'; ?>
<h1>Labb 1a Sida 4</h1>
<p>På denna sida kan du skriva in längd och bredd på en rektangel och få dess area och omkrets uträknad.</p>

<!--Formulär för att ta emot längd och bredd på rektangeln -->
<form action="sida4.php" method="POST"> 
        Längd: <input type="number" name="length"><br>
        Bredd: <input type="number" name="width"><br>
        <input type="submit" value="Beräkna">
</form> 

<?php 
/*Funktion för att beräkna area på rektangeln */
    function calculateArea($length, $width) {
        return $length * $width;
    }
/*Funktion för att beräkna omkrets på rektangeln */
    function calculateCircumference($length, $width) {
        $circumference = 2 * ($length + $width);
        $area = calculateArea($length, $width);
        echo "Omkretsen på rektangeln är: " . $circumference . "<br>";
        echo "Arean på rektangeln är: " . $area . "<br>"; 
    }
    /*Kollar att längd och bredd är ifyllda i formuläret */
    if (isset($_POST["length"]) && isset($_POST["width"])) {
        $length = $_POST["length"];
        $width = $_POST["width"];
    
        /*Kollar att längd och bredd är positiva värden */
        if ($length > 0 && $width > 0) {
            $circumference = calculateCircumference($length, $width); /* Anropar funktionen för att beräkna omkrets och area */
        } else {
            /*Skriver ut felmeddelande om längd och bredd inte är positiva värden */
            echo "<p>Vänligen ange positiva värden för längd och bredd.</p>";
        }
    }

?>
    <?php 
        include 'footer.php';
    ?>
</body>
</hmtl>