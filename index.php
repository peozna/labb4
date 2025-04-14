<?php 
session_start(); // Startar sessionen

	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) { // Kollar om användaren är inloggad
		header("Location: login.php"); // Om inte, skicka till inloggningssidan
		exit;
	}

?>

<!DOCTYPE html>
<html lang="sv">
<head>
	<meta charset="UTF-8">
	<title>Du är inloggad</title>
	<link rel="stylesheet" href="mystyle.css">
</head>

<body>
	<h1>Du är inloggad</h1>
	<p>	Välkommen,  <?php echo htmlspecialchars($_SESSION["username"])?>.</p>
	<a href="logout.php">Logga ut</a> <!-- Länk för att logga ut -->
</body>
</html>