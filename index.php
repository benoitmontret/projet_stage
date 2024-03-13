<?php
$userGroup = null;
setcookie('prev','index.php');
//s'il existe un cookie on definit le groupe avec, sinon on le fixe à général
if (!empty($_COOKIE['userGroup'])) {
    $userGroup = $_COOKIE['userGroup'];
} else {
    $userGroup='Général';
    setcookie('userGroup', 'Général', time()+3600*24*365*10); /* 3600*24*365*10 >> expiration 10ans*/
}
//s'il y a eut un changement detecter grace à la methode POST on definit le cookie
if (!empty($_POST['groupListe'])) {
    setcookie('userGroup', $_POST['groupListe'], time()+3600*24*365*10); /* 3600*24*365*10 >> expiration 10ans*/
    $userGroup = $_POST['groupListe'];
}

include("header.php");
include("login_option.php");
?>

<a class="button" href="login_annonce.php">Ajouter annonce</a> 



<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines WHERE lib_dom != 'Général' ORDER BY lib_dom ASC";
$req = $db->prepare($sql);
$req->execute();
?>

<div class="container">

    <div class="groupe_menu">

        <form  action="" id="groupForm" method="post">
            <select class="item_menu" name="groupListe" id="groupListe" size ="15" onchange="maj();">
                <option value="">-- Veuillez choisir un groupe --</option>
                <option value="Général" selected>Général </option>
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
        $sql = "SELECT id_annonce, titre, libelle, groupe, date_debut, date_fin FROM annonce WHERE (date_fin >= ? && (groupe='Général' || groupe=?))ORDER BY date_fin ASC ";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $now, PDO::PARAM_STR);
        $req->bindvalue(2, $userGroup, PDO::PARAM_STR);
        $req->execute();
    
        while ($row = $req->fetch()) { 
            echo '<div class="annonce '.$row["groupe"].'">';
            
            echo '<p class = "annonce_group">Groupe : ' . $row["groupe"] . '<p>';
            echo '<p class = "annonce_titre">Titre : ' . $row["titre"] . '<p>';
            echo '<p class="annonce_lib">Libellé : ';
                if ($row["libelle"]) {
                    echo $row["libelle"];
                } else {
                    echo 'Aucune description';
                }
            echo '<p>';

            

            echo '<p class="annonce_date">Date de début : ' . date("d/m/Y",strtotime($row["date_debut"])) . ' Date de fin : ' . date("d/m/Y",strtotime($row["date_fin"])).'<p>';
            
            echo '<a href="detail_annonce.php?id_annonce='.$row["id_annonce"].'">Voir plus</a>';
            echo "</div>";
        }
        ?>
    </div>
</div>

<?php
echo $now." ".$userGroup."<br><br>";
include("footer.php");
?>
