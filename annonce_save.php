<?php
$prev_page = $_COOKIE['prev'];
include("header.php");
include("login_option.php");


$titre=$_POST["titre"];
$libelle=$_POST["libelle"];
$Groupe=$_POST["Groupe"];
$date_start=$_POST["date_start"];
$date_end=$_POST["date_end"];
$auteur = $_COOKIE['user'];

include ("db.php");
$sql='INSERT INTO annonce (titre,libelle,groupe,date_debut,date_fin,auteur) values (?,?,?,?,?,?)';
    $req=$db->prepare($sql);
    $req->bindvalue(1,$titre,PDO::PARAM_STR);
    $req->bindvalue(2,nl2br($libelle),PDO::PARAM_STR);
    $req->bindvalue(3,$Groupe,PDO::PARAM_STR);
    $req->bindvalue(4,$date_start,PDO::PARAM_STR);
    $req->bindvalue(5,$date_end,PDO::PARAM_STR);
    $req->bindvalue(6,$auteur,PDO::PARAM_STR);
    

    if ($req->execute()) {

        echo "<p class='succes'>Annonce ajoutée avec succès !</p>";
        $id = $db->lastInsertId();
        $sql = "SELECT titre, libelle, groupe, date_debut, date_fin, auteur FROM annonce WHERE id_annonce=?";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $id, PDO::PARAM_STR);
        $req->execute();
            $resultat = $req->fetch();

            // Afficher les valeurs
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
            echo '</div>';

    } else {
        echo '<p class="log_err">Échec</p>';
    }

?>
<?php
echo '<div class="center_btn">';
    echo '<a class="button" href="index.php">Retour</a>';
echo '</div>';
include("footer.php");
?>