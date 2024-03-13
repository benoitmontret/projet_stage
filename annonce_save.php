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
$sql='insert into annonce (titre,libelle,groupe,date_debut,date_fin,auteur) values (?,?,?,?,?,?)';
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
        $sql = "SELECT titre, libelle, groupe, date_debut, date_fin FROM annonce WHERE id_annonce=?";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $id, PDO::PARAM_STR);
        $req->execute();
            $resultat = $req->fetch();

            // Afficher les valeurs
            echo "Titre : " , $resultat["titre"] , " ";
            echo "Groupe : " , $resultat["groupe"] , "<br>";
            echo "Libellé : " , $resultat["libelle"] , "<br>";
            echo "Date de début : " , date("d/m/Y",strtotime($resultat["date_debut"])) , " ";
            echo "Date de fin : " , date("d/m/Y",strtotime($resultat["date_fin"])) , "<br>";


        } else {

        echo "<p>Échec</p>";
        }

?>
<?php
include("footer.php");
?>