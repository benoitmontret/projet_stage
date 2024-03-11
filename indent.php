<?
unset($_COOKIE['ident']);
setcookie('ident', '', time() - 10); 
require_once("db.php");
$bnv=select_benevoles();

?>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/bootstrap/icons/font/bootstrap-icons.css">
    <title>Secours populaire Le Havre</title>
  </head>
  <body>
  <br><br><br><br><br>
  
  <div class="container">
  
  <form action="spf.php" method="get" >
   
  <div class="row justify-content-md-center">
        <div class="col-4">
                <select class="form-select" name="ident" required>
                      <option selected>Selectionnez votre nom</option>
                      <? foreach ($bnv  as $d) :?> 
                      <option value=<?=$d->id_bnv.'-'.str_replace(' ','-',$d->ident) ?>><?=$d->ident ?></option>
                    <? endforeach ;?>

                </select>
        </div>
  
  
        <div class="col-3">
            <input type="date" class="form-control" name="dt_nais" placeholder="Votre date de naissance"  required>
        </div>
    <div class="col-3">
        <button type="submit" class="btn btn-primary">OK pour accéder au menu</button>
    </div>  
  </form><br><br>
  <div class="alert alert-danger" role="alert">
 <?
 if (isset($_GET['msg'])){
    echo "<span align=center><H3> Date de naissance incorrecte</H3></span><BR>"; 
 } 
 else {
   echo "Evolution de l'authentification pour garantir la sécurité d'accès
   <br>Sélectionnez votre nom dans la liste puis saisissez votre date de naissance au format indiqué dans le champ <br>
   Dans quelques jours l'accès sera refusé si la date de naissance est incorrecte. Demandez à Louise de la modifier si besoin ";
 }
 ?>
  
  
</div>
</div>
</body>
</html>