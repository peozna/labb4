<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Gör sidan responsiv -->
    <title>Bloggportal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<?php include('header.php'); ?>

<div class="layout">
    <aside class="left">
        <?php include('menu.php'); ?>
    </aside>
    <main class="center">
        <?php include('content.php'); ?>
    </main>
    <aside class ="right">
        <?php 
        if(isset($_GET['blogger'])) {
        include('info.php');
        } ?>
    </aside>
</div>

<?php include('footer.php'); ?>
</body>