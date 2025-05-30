<?php
session_start(); // Startar sessionen
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('db.php'); // Inkluderar databasanslutningen

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    
        $query = "SELECT id, username, password FROM user WHERE username = ?";
        $statement = $connection->prepare($query);
        $statement ->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
    
            // Verifiera lösenordet
            if (password_verify($password, $user['password'])) {
                // Sätter session-variabler
                $_SESSION['user_id'] = $user['id']; // Lagra användar id i sessionen
                $_SESSION['username'] = $user['username']; // Lagra användarnamn i sessione

                // Omdirigera till dashboard
                header('Location: dash.php');
                exit();
            } else {
                echo "Felaktigt användarnamn eller lösenord.";
            }
        } else {
            echo "Felaktigt användarnamn eller lösenord.";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Logga in</title>
</head>
<body>
<h2>Logga in</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="login.php">k
    <label>Användarnamn: <input type ="text" name="username"></label><br>
    <label>Lösenord: <input type ="password" name="password"></label><br>
    <input type ="submit" value ="Logga in">
</form> 
</body>
</html>