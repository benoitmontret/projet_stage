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
        } else {

        echo "<p>Échec</p>";
        }

?>
<?php
include("footer.php");
?>