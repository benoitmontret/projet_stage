<?php
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
    $req->bindvalue(2,$libelle,PDO::PARAM_STR);
    $req->bindvalue(3,$Groupe,PDO::PARAM_STR);
    $req->bindvalue(4,$date_start,PDO::PARAM_STR);
    $req->bindvalue(5,$date_end,PDO::PARAM_STR);
    $req->bindvalue(6,$auteur,PDO::PARAM_STR);
    

    if ($req->execute()) {
        echo "<p>Annonce ajoutée avec succès !</p>";
        $id = $db->lastInsertId();
        $sql = "SELECT titre, libelle, groupe, date_debut, date_fin, auteur FROM annonce WHERE id_annonce=?";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $id, PDO::PARAM_STR);
        $req->execute();
            $resultat = $req->fetch();

            // Afficher les valeurs
            echo '<div class="annonce detail '.$resultat["groupe"].'">';
            
            echo '<p class = "annonce_group">Groupe : ' . $resultat["groupe"] . '<p>';
            echo '<p class = "annonce_titre">Titre : ' . $resultat["titre"] . '<p>';
            echo '<p class = "annonce_lib">Libellé : ';
                if ($resultat["libelle"]) {
                    echo $resultat["libelle"];
                } else {
                    echo 'Aucune description';
                }
            echo '<p>';
            echo '<p class = "annonce_auteur">Auteur : '.$resultat["auteur"].'<p>';
            echo '<p class="annonce_date">Date de début : ' . date("d/m/Y",strtotime($resultat["date_debut"])) . ' Date de fin : ' . date("d/m/Y",strtotime($resultat["date_fin"])).'<p>';
        
        echo "</div>";
        


        } else {

        echo "<p>Échec</p>";
        }

?>
<?php
include("footer.php");
?>