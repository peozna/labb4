<!DOCTYPE html>
<html lang="sv">
<head>
    <link rel="stylesheet" href="mystyle.css">
</head> 
<body>
<h1>Labb 1a Sida 4</h1>
<p>På denna sida kan du skriva in längd och bredd på en rektangel och få dess area och omkrets uträknad.</p>

<form action="" method="POST"> 
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
    
    if (isset($_POST["length"]) && isset($_POST["width"])) {
        $length = $_POST["length"];
        $width = $_POST["width"];
    
        if ($length > 0 && $width > 0) {
            $circumference = calculateCircumference($length, $width);
        } else {
            echo "<p>Vänligen ange positiva värden för längd och bredd.</p>";
        }
    }

?>


    <?php 
        include 'footer.php';
    ?>
</body>