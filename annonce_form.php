<?php
$userGroup = $_COOKIE['userGroup'];
include("header.php");
include("login_option.php")

?>
<head>
<script src="./assets/annonce.js" defer></script>
</head>

<h2>Ajouter une annonce</h2>



<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines WHERE lib_dom != 'Général' ORDER BY lib_dom ASC";
$req = $db->prepare($sql);
$req->execute();
?>
<div class="formulaire">

    <form  name="formulaire_annonce" id="formulaire_annonce" method="POST" action="annonce_save.php">
        <fieldset> <!-- encadrement -->
        <select class="item_menu" name="Groupe">
            <option value="">-- Veuillez choisir un groupe --</option>
            <option value="Général" selected>Général </option>
            
            <?php while ($row = $req->fetch()) { ?>
                <option value="<?php echo $row['lib_dom']; ?>" 
                <?php if ($userGroup == $row['lib_dom'])echo "selected"?> 
                ><?php echo $row['lib_dom']; ?>
            </option>
            <?php } ?>
        </select>
        <label for="titre">Titre* :</label> 
        <input class="item_menu" type="text" name="titre" id="titre" size="50"
        maxlength="255" minlength="2" placeholder="Donnez un titre ou une description courte pour l'annonce" autofocus = true required = "required">
        <br><br>
        <label class="item_menu" for="libelle">Details :</label><br>
        <textarea name="libelle" id="libelle" cols="150" rows="5" placeholder="Entrez les détails de l'annonce ici"></textarea>
        <br><br>
        <label for="date_start">Date de début* :</label>
        <input class="item_menu" type="date" name="date_start" id="date_start" required = "required" />
        <label for="date_end">Date de fin :</label>
        <input class="item_menu" type="date" name="date_end" id="date_end" />
        <p class="context_fin">S'il n'y a pas de date de fin de définit, elle sera fixée à la même date que celle du début.</p>
        <p class="mandatory">* Champs obligatoires</p>
        
        
        <br><br>
        <div class="center_btn">
        <input class= "button btn_valid" type="submit" value="Envoyer">
            </div>
    </fieldset>
</form>
</div>


<?php
include("footer.php");
?>