<?php
$user = null;
$err_message= null;
$prev_page = $_COOKIE['prev'];
include ("db.php");

// code obsolete, le logout se faisant sur logout.php
// reset des 'cookies user' quand on utilise le bouton "déconnexion"
// if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
//     unset($_COOKIE['user']);
//     setcookie('user', '', time()-10);
//     unset($_COOKIE['user_id']);
//     setcookie('user_id', '', time()-10);
// }

// si déjà connecté les 'cookies user' existe donc récupère leur valeur dans des variable php 
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
    $user_id = $_COOKIE['user_id'];


}
// si la méthode POST est appelé, verification et si ok création des 'cookies user'
if (!empty($_POST['nom'])) {
    $res = explode('|', $_POST['nom']); //$res[0] contient le nom+prénom, res[1] l'id bénévole
    $sql = "SELECT dt_nais FROM benevoles WHERE id_bnv=?";
        $req = $db->prepare($sql);
        $req -> bindvalue(1,$res[1],PDO::PARAM_INT);
        $req->execute();
        $resultat= $req->fetch();
    if ($resultat[0]!=$_POST['dt_nais']) {
        $err_message = '<p class="log_err">Erreur : Le nom et la date de naissance ne correspondent pas !!!</p>';
    } else {
        setcookie('user', $res[0], 0); //  deco avec la fermeture du navigateur 
        setcookie('user_id',$res[1], 0); //si nécessaire stock l'id
        $user=$res[0];
        $user_id=$res[1];

    }
}
include("header.php");
echo "<br>";
if ($err_message) {
    echo $err_message;
}

// si $user existe, donc quelqu’un est connecté => affiche som nom et un bouton de déconnexion
if ($user): ?>
<div class="log_status">
    <p class="user_login"><?= htmlentities($user) ?></p>
    <a class="button btn_warning" href="logout.php?action=deconnecter">Se déconnecter</a>
    <p class="log_mes"> Vous êtes connecté(e) !</p>
</div>

<?php else: 
// sinon on affiche le formulaire de connexion
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
                            <option selected disabled>Sélectionnez votre nom</option>
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
    echo '<a class="button" href="'.$prev_page.'">Retour page précédente</a>';
echo '</div>';
include("footer.php");
?>