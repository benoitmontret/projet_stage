<?php
include("header.php");

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
    $user = null;
} else {
    $user=$_COOKIE['user'];
}
?>
<div class="log_status">
    <?php
    if ($user): ?>
    
    <p>Bonjour <?= htmlentities($user) ?> Vous êtes arrivé ici par erreur ?</p>
    <a href="logout.php?action=deconnecter">Se déconnecter</a><br>
    <?php else: ?>
        <p class="logout_mes">Vous êtes déconnectez !</p>
        <?php endif;?>
        
        <!-- <a class="button" href="login.php">Se Connecter</a><br> -->
</div>

<?php
include("footer.php");
?>