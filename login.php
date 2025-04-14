<?php 
session_start(); // Startar sessionen

    $username = ""; 
    $password = ""; // Skapar tomma variabler för användarnamn och lösenord
    $error = []; // Skapar tom array för felmeddelanden
    $filename = "users.txt"; // Filnamn för att spara användarnamn och lösenord

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST["username"]); // Tar emot användarnamn från formuläret
        $password = htmlspecialchars($_POST["password"]); // Tar emot lösenord från formuläret

        if (empty($username)) {
            $error[] = "Vänligen fyll i användarnamn"; // Felmeddelande om användarnamn är tomt
        }

        if (empty($password)) {
            $error[] = "Vänligen fyll i lösenord"; // Felmeddelande om lösenord är tomt
        }

        if (empty($error)) {
            $usernameLower = strtolower($username); // Gör användarnamnet till gemener
        $file = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Öppnar filen för att läsa användarnamn och lösenord
            $users = []; // Skapar tom array för användare

            foreach ($file as $line) {
                [$savedUsername, $savedPassword] = explode(":", $line); // Dela upp varje rad i användarnamn och lösenord
                $users[strtolower($savedUsername)] = [$savedUsername, $savedPassword]; // Lägger till användarnamn och lösenord i arrayen
            }

        if (isset($_POST["login"])) { // Om knappen "Logga in" trycks
            if (isset($users[$usernameLower]) && password_verify($password, $users[$usernameLower][1])) { // Kolla om användarnamnet finns och lösenordet stämmer
                $_SESSION["loggedin"] = true;
                $_SESSION["username"] = $users[$usernameLower][0]; // Spara användarnamn i sessionen
                header("Location: index.php"); // Om inloggningen lyckas, skicka till index.php
                exit;
            } else {
                $error[] = "Felaktigt användarnamn eller lösenord"; // Felmeddelande om inloggningen misslyckas
            }  
        } else if (isset($_POST["register"])) { // Om knappen "Skapa ny användare" trycks
            if (isset($users[$usernameLower])) {
               $error[] = "Användarnamnet finns redan"; // Felmeddelande om användarnamnet redan finns
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hasha lösenordet
                file_put_contents($filename, "$username:$hashedPassword\n", FILE_APPEND); // Spara användarnamn och lösenord i filen
                $_SESSION ["loggedin"] = true; // Spara inloggning i sessionen
                $_SESSION ["username"] = $username; // Spara användarnamn i sessionen
                header("Location: index.php"); // Om registreringen lyckas, skicka till index.php
                exit;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Inloggning</title>
    <link rel="stylesheet" href="mystyle.css">
</head>

<body> 
    <h1>Logga in eller skapa användare</h1>

    <?php 
        if (!empty($error)) { // Om det finns felmeddelanden, skriv ut dem
            echo "<ul>";
            foreach ($error as $err) {
                echo "<li>$err</li>"; // Skriv ut varje felmeddelande i en lista
            }
            echo "</ul>";
        }
    ?>

    <form action="login.php" method="POST"> 
        Användarnamn: <input type="text" name="username" value="<?php echo htmlspecialchars($username)?>"><br>
        Lösenord: <input type="password" name="password"><br>
        <input type="submit" name="login" value="Logga in">
        <input type="submit" name="register" value="Skapa ny användare">
    </form>

</body>
</html>