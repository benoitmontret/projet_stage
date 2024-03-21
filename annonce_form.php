<?php
$prev_page = $_COOKIE['prev'];
$userGroup = $_COOKIE['userGroup'];
include("header.php");
include("login_option.php");

?>
<head>
<script src="./assets/annonce.js" defer></script>
</head>

<h2>Ajouter une annonce</h2>

<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines WHERE lib_dom != 'Pour tous' ORDER BY lib_dom ASC";
$req = $db->prepare($sql);
$req->execute();
?>
<div class="formulaire">

    <form  name="formulaire_annonce" id="formulaire_annonce" method="POST" action="annonce_save.php">
        <fieldset> <!-- encadrement -->
        <div class="form_head">
            <div>
                <label for="titre">Titre* :</label> 
                <input class="item_menu " type="text" name="titre" id="titre"
                maxlength="255" minlength="2" placeholder="Donnez un titre ou une description courte pour l'annonce" autofocus = true required = "required">
            </div>
            <select class="item_menu" name="Groupe">
                <option value="">-- Veuillez choisir un groupe --</option>
                <option value="Pour tous" selected>Pour tous </option>
                
                <?php while ($row = $req->fetch()) { ?>
                    <option value="<?php echo $row['lib_dom']; ?>" 
                    <?php if ($userGroup == $row['lib_dom'])echo "selected"?> 
                    ><?php echo $row['lib_dom']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <br>
        <label class="item_menu" for="libelle">Details :</label><br>
        <textarea name="libelle" id="libelle"  rows="5" placeholder="Entrez les détails de l'annonce ici"></textarea>
        <br><br>
        <div class="form_date">

            <div>
                <label for="date_start">Début * :</label>
                <input class="item_menu" type="date" name="date_start" id="date_start" required = "required"/>
            </div>
            <div>
                <label for="date_end">Fin :</label>
                <input class="item_menu" type="date" name="date_end" id="date_end" />
                <div class="context_fin">
                    <p>Attention : La date de fin correspond aussi à la fin de l'affichage sur la page principale.</p>
                    <p> Et si elle n'est pas définit, elle sera fixée à la même date que celle du début.</p>
                </div>
            </div>
        </div>
        <p class="mandatory">* Champs obligatoires</p>

        <div class="center_btn">
            <input class= "button btn_valid" type="submit" value="Envoyer">
        </div>
    </fieldset>
</form>
</div>


<?php
echo '<div class="center_btn">';
    echo '<a class="button" href="'.$prev_page.'">Retour</a>';
echo '</div>';

include("footer.php");
?>