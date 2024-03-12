<?php
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
} else {
    $user = null;
}
?>
<div class="log_status">
<?php
if ($user): ?>

    <p>Bonjour <?= htmlentities($user) ?></p>
    <a class = "button" href="logout.php?action=deconnecter">Se déconnecter</a><br>
    <?php else: ?>
        <a class = "button" href="login.php">Se connecter</a>
    <?php endif;?>
</div>
