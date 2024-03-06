<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">

    <title>Ajouter un événement</title>
</head>
<body>
    <p>hello</p>
<?php
$titre=$_POST["titre"];
$description=$_POST["description"];
$Groupe=$_POST["Groupe"];
$date_start=$_POST["date_start"];
$date_end=$_POST["date_end"];

include ("db.php");
$sql='insert into annonce (titre,description,groupe,date_debut,date_fin) values (?,?,?,?,?)';
    $req=$db->prepare($sql);
    // $req->bindvalue(1,nl2br($comment),PDO::PARAM_STR);
    $req->bindvalue(1,$titre,PDO::PARAM_STR);
    $req->bindvalue(2,$description,PDO::PARAM_STR);
    $req->bindvalue(3,$Groupe,PDO::PARAM_STR);
    $req->bindvalue(4,$date_start,PDO::PARAM_STR);
    $req->bindvalue(5,$date_end,PDO::PARAM_STR);
    // $req->execute();

    if ($req->execute()) {
        echo "<p>Annonce ajoutée avec succès !</p>";
        } else {

        echo "<p>Échec</p>";
        }

?>
</body>
</html>


