<?php
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
} else {
    $user =null;
}
$userGroup = $_COOKIE['userGroup'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" type="image/png" href="./assets/img/logosp.png">
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="./assets/main.js" defer></script>
    
</head>

<body>
    <header>
        <nav></nav>
        <div class="banner">
            <a href="index.php">
                <img class="logo" src="./assets/img/logosp.png " alt="">
            </a>

            <h2 class="userGroup" id="userGroup">GROUP</h2>
        </div>
    </header>

<?php
if ($user): ?>
    <h2>Bonjour <?= htmlentities($user) ?></h2>
    <a href="login.php?action=deconnecter">Se déconnecter</a><br>
<?php else: ?>
<a href="login.php">Connexion</a><br>
<?php endif; ?>
