<?php
include("header.php");
?>

<?php
$titre=$_POST["titre"];
$libellé=$_POST["libellé"];
$Groupe=$_POST["Groupe"];
$date_start=$_POST["date_start"];
$date_end=$_POST["date_end"];

include ("db.php");
$sql='insert into annonce (titre,libellé,groupe,date_debut,date_fin) values (?,?,?,?,?)';
    $req=$db->prepare($sql);
    $req->bindvalue(1,$titre,PDO::PARAM_STR);
    $req->bindvalue(2,$libellé,PDO::PARAM_STR);
    $req->bindvalue(3,$Groupe,PDO::PARAM_STR);
    $req->bindvalue(4,$date_start,PDO::PARAM_STR);
    $req->bindvalue(5,$date_end,PDO::PARAM_STR);
    // 

    if ($req->execute()) {
        echo "<p>Annonce ajoutée avec succès !</p>";
        $id = $db->lastInsertId();
        $sql = "SELECT titre, libellé, groupe, date_debut, date_fin FROM annonce WHERE id=?";
        $req = $db->prepare($sql);
        $req->bindvalue(1, $id, PDO::PARAM_STR);
        $req->execute();
            $resultat = $req->fetch();

            // Afficher les valeurs
            echo "Titre : " , $resultat["titre"] , " ";
            echo "Groupe : " , $resultat["groupe"] , "<br>";
            echo "Libellé : " , $resultat["libellé"] , "<br>";
            echo "Date de début : " , $resultat["date_debut"] , " ";
            echo "Date de fin : " , $resultat["date_fin"] , "<br>";


        } else {

        echo "<p>Échec</p>";
        }

?>
<?php
include("footer.php");
?>