<!-- herder.php contient l'ouverture du fichier html (!DOCTYPE balise head-body...) -->
<?php
include("header.php");
?>

<p>hello !</p> 
<a href="annonce_form.php">ajout annonce</a><br>

<!-- pour les test  -->
<?php
$user = "Compta";
?>

<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines";
$stmt = $db->query($sql);
?>

    <form name="groupListe" id="groupListe">
        <select name="Groupe" size ="15">
            <option value="">-- Veuillez choisir un groupe --</option>
            <?php while ($row = $stmt->fetch()) { ?>
                <option value="<?php echo $row['lib_dom']; ?>" 
                <?php if ($user == $row['lib_dom'])echo "selected"?> 
                ><?php echo $row['lib_dom']; ?>
                </option>
            <?php } ?>
            </select>




<!-- footer.php ferme les balises body et html -->
<?php
include("footer.php");
?>
