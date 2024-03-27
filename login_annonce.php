<?php
include ("login.php");

if ($user) {
    $user_id=$_COOKIE['user_id'];
    $userGroup = $_COOKIE['userGroup'];
    $sql = "SELECT lib_dom, id_referent FROM domaines WHERE lib_dom=?";
    $req = $db->prepare($sql);
    $req -> bindvalue(1,$userGroup,PDO::PARAM_STR);
    $req ->execute();
    $dom_ref = $req->fetch();

    if ($user_id != $dom_ref[0]) {
        echo $user_id.' <-> '.$dom_ref[0].'  '.$dom_ref[1].' '.$userGroup;
        echo "<p class='log_err'>Attention : Seul les referent d'un groupe peuvent ajouter une annonce !</p>";
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



