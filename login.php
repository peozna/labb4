<?php
session_start(); // Startar sessionen
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('db.php'); // Inkluderar databasanslutningen

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    
        $query = "SELECT id, username, password FROM user WHERE username = ?";
        $statement = $connection->prepare($query);
        $statement = $connection->prepare($query);
        $statement->bind_param('s', $username);
        $statement->execute();
        $result = $statement->get_result();
    
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
    
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id']; // Store user ID in session
                $_SESSION['username'] = $user['username']; // Store username in session
    
                // Redirect to the dashboard
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
<h2>Logga in</h2>
<?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
<form method="POST" action="auth.php">k
    <label>Användarnamn: <input type ="text" name="username"></label><br>
    <label>Lösenord: <input type ="text" name="password"></label><br>
    <input type ="submit" value ="Logga in">
</form> 