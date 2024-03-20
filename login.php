<?php
$user = null;
$err_message= null;
$prev_page = $_COOKIE['prev'];
include ("db.php");

if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
    // unset($_COOKIE['user_id']);
    // setcookie('user_id', '', time()-10);

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
    if ($resultat[0]!=$_POST['dt_nais']) {
        $err_message = '<p class="log_err">Erreur : Le nom et la date de naissance ne correspondent pas !!!</p>';
    } else {
        setcookie('user', $res[0], time()+3600); //3600=1h modifier selon besoin, retient le cookie quand le navigateur est fermé, si l'on veut une deco avce la fermeture du navigateur il faut le set à 0
        // setcookie('user_id',$res[1], time()+3600); //si necessaire stock l'id, retirer aussi le commentaire ligne 10-11 pour l'unset
        $user=$res[0];
    }
}
include("header.php");

if ($err_message) {
    echo $err_message;
}

if ($user): ?>
<div class="log_status">
    <p class="user_login"><?= htmlentities($user) ?></p>
    <a class="button" href="logout.php?action=deconnecter">Se déconnecter</a>
    <p class="log_mes"> Vous êtes connecté(e) !</p>

</div>

<?php else: 
    $sql = "SELECT id_bnv, nom, pnom FROM benevoles ORDER BY nom";
    $req = $db->prepare($sql);
    $req->execute();
?>

    <div class="formulaire">
        <form action="" method="POST">
            <fieldset>
                <div class="log_form">
                    <div>
                        <label class="item_menu" for="nom">Nom</label><br>
                        <select class="item_menu log_nom" name="nom" required>
                            <option selected disabled>Selectionnez votre nom</option>
                            <?php while ($row = $req->fetch()) { ?>
                                <option value="<?php echo $row['nom']." ".$row["pnom"]."|".$row["id_bnv"]; ?>" 
                                ><?php echo $row['nom']." ".$row["pnom"]; ?>
                            </option>
                            <?php } ?>
                        </select><br>
                    </div>
                    <div>
                        <label class="item_menu" for="dt_nais">Votre date de naissance</label><br>
                        <input class="item_menu log_date" type="date" name="dt_nais"  placeholder="Votre date de naissance" required/><br>
                    </div>
                </div>
                <br>
                <div class="center_btn">
                    <input class="button btn_valid" type="submit" value="Connexion">
                </div>
                <?php endif;?> 
            </fieldset>
        </form>
    </div>

<?php
echo '<div class="center_btn">';
    echo '<a class="button" href="'.$prev_page.'">Retour</a>';
echo '</div>';
include("footer.php");
?>