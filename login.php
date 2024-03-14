<?php
$user = null;
// if (isset($_COOKIE['prev'])){
    $prev_page = $_COOKIE['prev'];
//     unset($_COOKIE['prev']);

// } else {
//     setcookie('prev', $_SERVER['HTTP_REFERER']);
    
// }

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
}
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
}
if (!empty($_POST['nom'])) {
    setcookie('user', $_POST['nom'], time()+3600); //3600=1h modifier selon besoin
    $user=$_POST['nom'];
    // Rediriger vers la page précédente
    // header("Location: " . $prev_page);

}

include("header.php");

if ($user): ?>
<div class="log_status">

    <p class="user_login"><?= htmlentities($user) ?></p>
    
    <a class="button" href="logout.php?action=deconnecter">Se déconnecter</a><br>
</div>
<?php else: 
    include ("db.php");
    $sql = "SELECT nom, pnom FROM benevoles ORDER BY nom";
    $req = $db->prepare($sql);
    $req->execute();
    ?>
    <form class="formulaire" action="" method="POST">
        <select class="item_menu" name="nom" required>
            <option selected>Selectionnez votre nom</option>

            <?php while ($row = $req->fetch()) { ?>
                <option value="<?php echo $row['nom']." ".$row["pnom"]; ?>" 
                ><?php echo $row['nom']." ".$row["pnom"]; ?>
                </option>
            <?php } ?>
        </select>
        
        <input class="item_menu" type="date" name="dt_nais" placeholder="Votre date de naissance"  />
        <!-- ajouter required -->
        <br>
        <input class="button btn_valid" type="submit" value="Connexion">
<?php endif;?> 
</form>
<?php
include("footer.php");
?>
