<?php
include("header.php");

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
    $user = null;
} else {
    $user=$_COOKIE['user'];
}

if ($user): ?>
    <h2>Bonjour <?= htmlentities($user) ?> Vous êtes arrivé ici par erreur ?</h2>
    <a href="logout.php?action=deconnecter">Se déconnecter</a><br>
    <?php else: ?>
        <h2>Vous êtes déconnectez !</h2>
        <?php endif;?>

<a href="login.php">Connexion</a><br>

<?php
include("footer.php");
?>