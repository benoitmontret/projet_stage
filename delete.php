<?php
setcookie('prev','detail_annonce.php?id='.$_GET['id']);

include ("db.php");
include("header.php");
include("login_option.php");
if (($_SERVER["REQUEST_METHOD"] === "POST") AND (strtolower($_POST['suppr']) === "oui")) {
    $id_annonce=$_POST["id_annonce"];
    $sql='DELETE from annonce WHERE id_annonce=?';
    $req=$db->prepare($sql);
    $req->bindvalue(1,$id_annonce,PDO::PARAM_INT);
    $req->execute(); 
        // et on efface tous les commentaires lié
        $sql='DELETE from comm_annonce WHERE id_annonce=?';
        $req=$db->prepare($sql);
        $req->bindvalue(1,$id_annonce,PDO::PARAM_INT);
        $req->execute(); 
        echo "<p class='log_err'>Annonce supprimée</p>";

    // On recharge la page sans le POST pour eviter le renvoie des donnée si on raffraichi la page plutard
    // $url = 'delete.php?id='.$_GET['id'];
    // header("Refresh: 0 ;url=$url");
} else {


    $id=$_GET['id'];
    $sql = "SELECT titre, libelle, groupe, date_debut, date_fin, auteur FROM annonce where id_annonce=?";
    $req = $db->prepare($sql);
    $req->bindvalue(1, $id, PDO::PARAM_INT);
    $req->execute();
    $resultat = $req->fetch();
    if ($resultat) {

        echo '<div class="annonce detail '.$resultat["groupe"].'">';
        echo '<div class="annonce_head">';
        echo '<p class = "annonce_titre">' . $resultat["titre"] . '</p>';
        echo '<p class = "annonce_group">' . $resultat["groupe"] . '</p>';
        echo '</div>';
        echo '<p class = "annonce_lib">';
        if ($resultat["libelle"]) {
            echo $resultat["libelle"];
        } else {
            echo 'Aucune description';
        }
        echo '</p>';
        echo '<div class="date_auteur">';
        echo '<p class="annonce_date">Du : ' . date("d/m/Y",strtotime($resultat["date_debut"])) . ' Au : ' . date("d/m/Y",strtotime($resultat["date_fin"])).'</p>';
        echo '<p class = "annonce_auteur">'.$resultat["auteur"].'</p>';
        echo '</div>';
        echo "</div><br>";
        ?>

        <div class="formulaire">
    
            <form  name="supprimer" id="supprimer" method="POST" action="">
                <fieldset> <!-- encadrement -->
                <input type="hidden" name="id_annonce" value="<?php echo $id ?>">  <!-- Ajout de l'id reference de facon invisible -->
                <label class="item_menu" for="suppr">Voulez vous vraiment effacer cette annonce ?</label><br>
                <label class="item_menu">Tapez "oui" en toutes lettres pour comfirmer votre choix !</label><br>
                <input class="item_menu" type="text" name="suppr" id="suppr" maxlength="3">
        
                <div class="center_btn">
                    <input class= "button btn_warning" type="submit" value="SUPPRIMER">
                </div>
                </fieldset>
            </form>
        </div>
<?php
    } else { echo "<p class='log_err'>Cette annonce n'existe pas !</p>";}
}
echo '<div class="center_btn">';
    echo '<a class="button" href="index.php">Retour  à la page d\'accueil</a>';
echo '</div>';

include("footer.php");
?>
