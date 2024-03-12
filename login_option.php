<?php
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
} else {
    $user = null;
}


if ($user): ?>

    <h2>Bonjour <?= htmlentities($user) ?></h2>
    <a href="logout.php?action=deconnecter">Se déconnecter</a><br>
<?php else: ?>
    <a href="login.php">Se connecter</a>

<?php endif;?>
