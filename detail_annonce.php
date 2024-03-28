<?php
setcookie('prev','detail_annonce.php?id='.$_GET['id']);

include ("db.php");
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_annonce=$_POST["id_annonce"];
    $comm=$_POST["comm"];
    $auteur_comm=$_POST["auteur_comm"];
    $sql='INSERT into comm_annonce (comm,auteur_comm,id_annonce) values (?,?,?)';
    $req=$db->prepare($sql);
    $req->bindvalue(1,nl2br($comm),PDO::PARAM_STR);
    $req->bindvalue(2,$auteur_comm,PDO::PARAM_STR);
    $req->bindvalue(3,$id_annonce,PDO::PARAM_STR);
    
    $req->execute();
    $sql2="UPDATE annonce SET nb_comm = nb_comm +1 WHERE id_annonce = $id_annonce";
    $req2=$db->prepare($sql2);
    $req2->execute();
    // On recharge la page sans le POST pour eviter le renvoie des donnée si on raffraichi la page plutard
    $url = 'detail_annonce.php?id='.$_GET['id'];
    header("Refresh: 0 ;url=$url");
}

include("header.php");
?>

<div class="page_up">
    <a href="#page_down">
        <img  src="./assets/img/arrow-down.svg" alt="fleche vers le bas">
    </a>
</div>

<?php
    include("login_option.php");

$now=time();
$id=$_GET['id'];
$sql = "SELECT titre, libelle, groupe, date_debut, date_fin, auteur FROM annonce where id_annonce=?";
$req = $db->prepare($sql);
$req->bindvalue(1, $id, PDO::PARAM_INT);
$req->execute();
$resultat = $req->fetch();

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

    // si utilisateur connecté, test si il référent pour afficher le bouton supprimer
    if ($user) {
        $userGroup = $_COOKIE['userGroup'];
        $user_id = $_COOKIE['user_id'];
        $sql = "SELECT id_referent FROM domaines WHERE lib_dom=?";
        $req = $db->prepare($sql);
        $req -> bindvalue(1,$userGroup,PDO::PARAM_STR);
        $req ->execute();
        $res = $req->fetch();
    
        if ($user_id == $res['id_referent']) {
            echo '<div class="center_btn">';
                echo '<a class="button btn_warning" href="delete.php?id='.$id.'">Supprimer</a>';
            echo '</div>';
        }
    }

        $sql2="SELECT comm, auteur_comm, date_post FROM comm_annonce WHERE id_annonce=? ORDER BY id_comm ASC";
        $req = $db->prepare($sql2);
        $req->bindvalue(1, $id, PDO::PARAM_INT);
        $req->execute();
        if ($req->rowCount()>0) {
            while ($row = $req->fetch()) { 
                    echo '<div class="commentaire">';
                        echo '<p class="comm_item">'.$row["comm"].'</p> ';
                        echo '<div class="date_auteur">';
                            echo '<p class="interval">Posté il y a : ';
                            $delay= $now-strtotime($row["date_post"]);
                            // Convertir la différence en jours, heures, minutes et secondes
                            $jours = floor($delay / (60 * 60 * 24));
                            $heures = floor(($delay % (60 * 60 * 24)) / (60 * 60));
                            $minutes = floor(($delay % (60 * 60)) / 60);
                            $res = (($jours >0) ? $jours." jour(s) " : "") . (($heures >0) ? $heures." heures " : "") . $minutes." minutes</p>"; 
                            echo $res;
                            echo '<p class="comm_auteur">'.$row["auteur_comm"].'</p> ';
                        echo '</div>';
                    echo '</div>';
                };
            } else {
                echo "<p>Il n'y aucun commentaire.</p>";
            };

echo "</div><br>";
?>

<div class="formulaire">

    <form  name="formulaire_annonce" id="formulaire_annonce" method="POST" action="">
        <fieldset> <!-- encadrement -->
        <input type="hidden" name="id_annonce" value="<?php echo $id ?>">  <!-- Ajout de l'id reference de facon invisible -->
        <label class="item_menu" for="comm">Commentaire* :</label><br>
        <textarea name="comm" id="comm" rows="3" placeholder="Laissez votre commentaire ici"  required = "required"></textarea>
        <br><br>
        <label for="auteur_comm">Votre nom* :</label> 
        <input class="item_menu" type="text" name="auteur_comm" id="auteur_comm"
        maxlength="255" minlength="2" placeholder="Votre nom ou un pseudo" required = "required"
        <?php
            if (isset($user)) {
                echo 'value="'.$user.'"';
            }
        ?>
        >
        <br><br>
        <p class="mandatory">* Champs obligatoires</p>
        <br><br>
        <div class="center_btn">
            <input class= "button btn_valid" type="submit" value="Laisser un commentaire">
        </div>
        </fieldset>
    </form>
</div>
    
<?php
echo '<div class="center_btn">';
    echo '<a class="button" href="index.php">Retour  à la page d\'accueil</a>';
echo '</div>';
?>

<div class="page_down">
    <a  href="#page_up">
        <img src="./assets/img/arrow-up.svg" alt="fleche vers le haut">
    </a>
</div>

<?php
include("footer.php");
?>