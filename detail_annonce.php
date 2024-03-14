<?php
setcookie('prev','detail_annonce.php');

include("header.php");
include("login_option.php");
include ("db.php");

$sql = "SELECT titre, libelle, groupe, date_debut, date_fin, auteur FROM annonce where id_annonce=?";
$req = $db->prepare($sql);
$req->bindvalue(1, $_GET['id_annonce'], PDO::PARAM_INT);
$req->execute();
$resultat = $req->fetch();

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
?>








<span class="button">Ajouter Commentaire</span> 





<?php
include("footer.php");
?>