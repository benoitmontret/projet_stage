<?php
ob_start();
$user = null;
$prev_page = $_COOKIE['prev'];
include ("db.php");

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
}
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
}
if (!empty($_POST['nom'])) {
    $res = explode('|', $_POST['nom']); //$rres[0] contient le nom+prenom, res[1] l'id bénévol
    $sql = "SELECT dt_nais FROM benevoles WHERE id_bnv=?";
    $req = $db->prepare($sql);
    $req -> bindvalue(1,$res[1],PDO::PARAM_INT);
    $req->execute();
        $resultat= $req->fetch();
    echo $resultat[0].'<br>'.$_POST['dt_nais'];
    if ($resultat[0]!=$_POST['dt_nais']) {
        echo '<p class="log_err">Erreur : Le nom et la date de naissance ne correspondent pas !!!</p>';
    } else {

        // echo "nom: ". $res[0]."<br />";
        // echo "id: ". $res[1]."<br />";
        setcookie('user', $res[0], time()+3600); //3600=1h modifier selon besoin
        $user=$res[0];
    }
}
$test = ob_get_clean();
include("header.php");
echo $test;


if ($user): ?>
<div class="log_status">
    <p class="user_login"><?= htmlentities($user) ?></p>
    <a class="button" href="logout.php?action=deconnecter">Se déconnecter</a><br>
    <p class="log_mes"> Vous êtes connecté(e) !</p>
</div>

<?php else: 
    $sql = "SELECT id_bnv, nom, pnom FROM benevoles ORDER BY nom";
    $req = $db->prepare($sql);
    $req->execute();
    ?>
    <div class="log_mes">
    <form class="formulaire" action="" method="POST">
        <select class="item_menu" name="nom" required>
            <option selected disabled>Selectionnez votre nom</option>
            

            <?php while ($row = $req->fetch()) { ?>
                <option value="<?php echo $row['nom']." ".$row["pnom"]."|".$row["id_bnv"]; ?>" 
                ><?php echo $row['nom']." ".$row["pnom"]; ?>
                </option>
            <?php } ?>
        </select>
        
        <input class="item_menu" type="date" name="dt_nais" placeholder="Votre date de naissance"  selected/>
        <!-- ajouter required -->
        <br><br>
        <input class="button btn_valid" type="submit" value="Connexion">
<?php endif;?> 
</form>
</div>
<?php


echo '<div class="center_btn">';
    echo '<a class="button" href="'.$prev_page.'">Retour</a>';
echo '</div>';
include("footer.php");
?>