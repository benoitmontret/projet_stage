<?php
    $prev_page = "index.php";

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
        <a class="button" href="login.php">Se Connecter</a><br>
        <p class="log_mes">Vous êtes déconnecté(e) !</p>
        <?php endif;?>

</div>

<?php
echo '<div class="center_btn">';
echo '<a class="button" href="'.$prev_page.'">Retour</a>';
echo '</div>';
include("footer.php");
?>