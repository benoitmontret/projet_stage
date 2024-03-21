<?php
$userGroup = null;
setcookie('prev','index.php');
//s'il existe un cookie on definit le groupe avec, sinon on le fixe à Pour tous
if (!empty($_COOKIE['userGroup'])) {
    $userGroup = $_COOKIE['userGroup'];
} else {
    $userGroup='Pour tous';
    setcookie('userGroup', 'Pour tous', time()+3600*24*365*10); /* 3600*24*365*10 >> expiration 10ans*/
}
//s'il y a eut un changement detecter grace à la methode POST on definit le cookie
if (!empty($_POST['groupListe'])) {
    setcookie('userGroup', $_POST['groupListe'], time()+3600*24*365*10); /* 3600*24*365*10 >> expiration 10ans*/
    $userGroup = $_POST['groupListe'];
}

include("header.php");
include("login_option.php");

// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines WHERE lib_dom != 'Pour tous' ORDER BY lib_dom ASC";
$req = $db->prepare($sql);
$req->execute();
?>

<div class="container">

    <div class="groupe_menu">
        <form  action="" id="groupForm" method="post">
            <select class="item_menu" name="groupListe" id="groupListe" size ="30" onchange="maj();">
                <option value="">-- Choisir un groupe --</option>
                <option value="Pour tous" selected>Pour tous </option>
                <?php while ($row = $req->fetch()) { ?>
                    <option value="<?php echo $row['lib_dom']; ?>" 
                    <?php if ($userGroup == $row['lib_dom'])echo "selected"?> 
                    ><?php echo $row['lib_dom']; ?>
                </option>
                <?php } ?>
            </select>
        </form>
    </div>

    <div class="liste_annonce">
        <?php
        //récupération des annonces
        $now=date("Y-m-d"); //date du jour au format dans la table pour pouvoir comparer
        $sql = "SELECT id_annonce, titre, libelle, groupe, date_debut, date_fin,date_modif, auteur, nb_comm FROM annonce WHERE (date_fin >= ? && (groupe='Pour tous' || groupe=?))ORDER BY date_fin ASC ";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $now, PDO::PARAM_STR);
        $req->bindvalue(2, $userGroup, PDO::PARAM_STR);
        $req->execute();
        $max=200; //limite pour le libellé
        $now=time();
        while ($row = $req->fetch()) { 
            echo '<div class="annonce '.$row["groupe"].'">';
                echo '<div class="annonce_head">';
                    echo '<p class = "annonce_titre">' . $row["titre"] . '</p>';
                    echo '<p class = "annonce_group">' . $row["groupe"] . '</p>';
                echo '</div>';
                    echo '<p class="annonce_lib">';
                    if ($row["libelle"]) {
                        echo substr($row["libelle"], 0, $max);
                        if (strlen($row["libelle"])>$max){
                            echo' (...)<span class="annonce_troncature"> Cliquez sur "Voir plus" pour lire la suite !</span>';
                        }
                    } else {
                        echo 'Aucune description';
                    }
                echo '</p>';
            echo '<div class="date_auteur">';
                echo '<p class="annonce_date">Affiché du : ' . date("d/m/Y",strtotime($row["date_debut"])) . ' au : ' . date("d/m/Y",strtotime($row["date_fin"])).'</p>';
                echo '<p class = "annonce_auteur">'.$row["auteur"].'</p>';
            echo '</div>';
                echo '<p class="annonce_nbcom">Il y a '.$row['nb_comm'].' commentaires. ';
                echo 'Dernière modification : ';
                    $delay= $now-strtotime($row["date_modif"]);
                    // Convertir la différence en jours, heures, minutes et secondes
                    $jours = floor($delay / (60 * 60 * 24));
                    $heures = floor(($delay % (60 * 60 * 24)) / (60 * 60));
                    $minutes = floor(($delay % (60 * 60)) / 60);
                    $res = (($jours >0) ? $jours." jour(s) " : "") . (($heures >0) ? $heures." heures " : "") . $minutes." minutes</>"; 
                    echo $res.'</p>';
                echo '<div class="btn_plus">';
                    echo '<a class="button" href="detail_annonce.php?id='.$row["id_annonce"].'">Voir plus</a>';
                echo "</div>";
            echo "</div>";
        }
        ?>
        <div class="center_btn">
            <a class="button" href="login_annonce.php">Ajouter annonce</a> 
        </div>
    </div>
</div>


<?php
include("footer.php");
?>
