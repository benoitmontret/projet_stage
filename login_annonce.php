<?php
include ("login.php");

if ($user) {
    $userGroup = $_COOKIE['userGroup'];
    $sql = "SELECT id_referent FROM domaines WHERE lib_dom=?";
    $req = $db->prepare($sql);
    $req -> bindvalue(1,$userGroup,PDO::PARAM_STR);
    $req ->execute();
    $res = $req->fetch();

    if ($user_id != $res['id_referent']) {
        ?>
        <div id="referent" class="modal" style="    visibility: visible">
            <div class="modal_content">
                <p class='log_err'>Attention : Seuls les référents d'un groupe peuvent ajouter une annonce !</p>
                <p>Si vous êtes bien référent, veuillez vérifier et sélectionner votre groupe sur la page d’accueil.</p>
                <p>Sinon contacter votre référent.</p>
<div class="center_btn">
    <a class="button" href="index.php">Retour  à la page d\'accueil</a>
</div>
            </div>
        </div>
        <?php
        echo "<p class='log_err'>Attention : Seuls les référents d'un groupe peuvent ajouter une annonce !</p>";
    } else {
        ?>
            <head>
                <!-- permet la redirection vers le formulaire d'ajout quand on est connecté -->
                    <meta http-equiv="refresh" content="0; URL=annonce_form.php" /> 
            </head>
        <?php
    }
}
?>



