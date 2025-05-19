<?php 
include_once('db.php'); // Inkluderar databasanslutningen
session_start(); // Startar sessionen

$errors = []; // Skapar en tom array för felmeddelanden
$success = ''; // Skapar en tom sträng för framgångsmeddelanden

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']); // Hämtar användarnamnet från formuläret och tar bort onödiga mellanslag
    $password = trim($_POST['password']); // Hämtar lösenordet från formuläret och tar bort onödiga mellanslag

    if(empty($username) || empty($password)) { //Kontrollerar att fälten inte är tomma
        $errors[] = 'Fyll i alla fält.'; // Lägger till felmeddelande i arrayen
    } else {
        $existing_user = get_user($username);
        if (!empty($existing_user)) { //Kontrollerar om användarnamnet är upptaget
            $errors[] = 'Användarnamnet är upptaget.';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashar lösenordet
            add_user($username, $hashedPassword); // Lägger till användaren i databasen
            
            //Lägger till användarnamnet i en textfil
            $filename = "../uploads/users.txt";
            file_put_contents($filename, $username . PHP_EOL, FILE_APPEND);

            $success = "Användaren har registrerats, du kan nu logga in"; // Sätter framgångsmeddelande
        }
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Registrera ny användare</title>
    <link rel="stylesheet" href="style.css"> <!-- Länkar till CSS-filen för styling -->
</head>
<body>
    <h1>Registrera ny användare</h1>
    <?php if(!empty($errors)) { ?> <!-- Om det finns felmeddelanden, skriv ut dem -->
        <div class="error">
            <?php foreach($errors as $error) { ?>
                <p><?= htmlspecialchars($error) ?></p> <!-- Skriver ut varje felmeddelande -->
            <?php } ?>
        </div>
    <?php } ?>
    <?php if(!empty($success)) { ?> <!-- Om det finns ett framgångsmeddelande, skriv ut det -->
        <div class="success">
            <p><?= htmlspecialchars($success) ?></p> <!-- Skriver ut framgångsmeddelandet -->
        </div>
    <?php } ?>

    <form method="POST"> <!-- Formulär för att registrera ny användare -->
        <label for="username">Användarnamn:</label><br>
        <input type="text" id="username" name="username" required><br><br> <!-- Inmatningsfält för användarnamn -->
        <label for="password">Lösenord:</label><br>
        <input type="password" id="password" name="password" required><br><br> <!-- Inmatningsfält för lösenord -->
        <input type="submit" value="Registrera"> <!-- Skicka-knapp -->
    </form>
    <a href="login.php">Tillbaka till inloggning</a> <!-- Länk tillbaka till inloggningssidan -->
    </body>
    </html>
