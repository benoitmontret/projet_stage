<?php
// $userGroup = $_COOKIE['userGroup'];
include("header.php");
?>
<head>
<script src="./assets/annonce.js" defer></script>
</head>

<h2>titre de la page 1</h2>



<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines WHERE lib_dom != 'Général' ORDER BY lib_dom ASC";
$req = $db->prepare($sql);
$req->execute();
?>

    <form name="formulaire_annonce" id="formulaire_annonce" method="POST" action="annonce_save.php">
    <fieldset> <!-- encadrement -->
        <select name="Groupe">
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
            <input type="text" name="titre" id="titre" size="50"
            maxlength="255" minlength="2" placeholder="Donnez un titre ou une description courte pour l'annonce" autofocus = true required = "required">
            <br><br>
        <label for="libellé">Details :</label><br>
        <textarea name="libellé" id="libellé" cols="150" rows="5" placeholder="Entrez les détails de l'annonce ici"></textarea>
            <br><br>
        <label for="date_start">Date de début* :</label>
            <input type="date" name="date_start" id="date_start" required = "required" />
        <label for="date_end">Date de fin :</label>
            <input type="date" name="date_end" id="date_end" />
            <p class="context_fin">S'il n'y a pas de date de fin de définit, elle sera fixée à la même date que celle du début.</p>

        
        <br><br>
        <input type="submit" value="Envoyer">
    </fieldset>
    </form>


<?php
include("footer.php");
?>