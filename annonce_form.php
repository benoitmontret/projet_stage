<!-- herder.php contient l'ouverture du fichier html (!DOCTYPE balise head-body...) -->
<?php
include("header.php");
?>
<head>
<script src="./assets/script.js" defer></script>
</head>

<h2>titre de la page 1</h2>

<!-- pour les test  -->
<?php
$user = "Compta";
?>

<body>

<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines";
$stmt = $db->query($sql);
?>

    <form name="formulaire_annonce" id="formulaire_annonce" method="POST" action="annonce_save.php">
    <fieldset> <!-- encadrement -->
        <select name="Groupe">
            <option value="">-- Veuillez choisir un groupe --</option>
            <?php while ($row = $stmt->fetch()) { ?>
                <option value="<?php echo $row['lib_dom']; ?>" 
                <?php if ($user == $row['lib_dom'])echo "selected"?> 
                ><?php echo $row['lib_dom']; ?>
                </option>
            <?php } ?>
            </select>
        <label for="titre">Titre* :</label> 
            <input type="text" name="titre" id="titre" size="50"
            maxlength="255" minlength="2" placeholder="Donnez un titre ou une description courte pour l'annonce" autofocus = true required = "required">
            <br><br>
        <label for="description">Details :</label><br>
        <textarea name="description" id="description" cols="150" rows="5" placeholder="Entrez les détails de l'annonce ici"></textarea>
            <!-- <input type="text" name="description" id="description" size="100"
            placeholder="Entrez les détails de l'événement ici" > -->
            <br><br>
        <label for="date_start">Date de début* :</label>
            <input type="date" name="date_start" id="date_start" required = "required" />
        <label for="date_end">Date de fin :</label>
            <input type="date" name="date_end" id="date_end" />
            <p class="context_fin">S'il n'y a pas de date de fin de définit, elle sera fixé à la même date que celle du début.</p>

        
        <br><br>
        <input type="submit" value="Envoyer">
    </fieldset>
    </form>


<!-- footer.php ferme les balises body et html -->
<?php
include("footer.php");
?>