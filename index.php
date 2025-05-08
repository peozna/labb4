<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
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
        <?php include('info.php'); ?>
    </aside>
</div>

<?php include('footer.php'); ?>
</body>