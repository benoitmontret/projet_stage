<?php
$userGroup = null;
//s'il existe un cookie on definit le groupe avec, sinon on le fixe à général
if (!empty($_COOKIE['userGroup'])) {
    $userGroup = $_COOKIE['userGroup'];
} else {
    $userGroup='Général';
    setcookie('userGroup', 'Général', time()+3600); /* expire dans 1 heure (*24*365*10 >> expiration 10ans)*/
}
//s'il y a eut un changement detecter grace à la methode POST on definit le cookie
if (!empty($_POST['groupListe'])) {
    setcookie('userGroup', $_POST['groupListe'], time()+3600); /* expire dans 1 heure (*24*365*10 >> expiration 10ans)*/
    $userGroup = $_POST['groupListe'];
}

include("header.php");
?>

<p>hello !</p> 
<a href="annonce_form.php">ajout annonce</a><br>


<?php
// $userGroup = "Accueil"; //pour les test
// $userGroup = $_SESSION['userGroup'];
?>

<?php
// Récupération de la liste des groupes dans la base de donnée
include ("db.php");
$sql = "SELECT lib_dom FROM domaines";
$stmt = $db->query($sql);
?>

<form action="" id="groupForm" method="post">
    <select name="groupListe" id="groupListe" size ="15" onchange="maj();">
        <option value="">-- Veuillez choisir un groupe --</option>
        <?php while ($row = $stmt->fetch()) { ?>
            <option value="<?php echo $row['lib_dom']; ?>" 
            <?php if ($userGroup == $row['lib_dom'])echo "selected"?> 
            ><?php echo $row['lib_dom']; ?>
            </option>
        <?php } ?>
    </select>
</form>



<!-- footer.php ferme les balises body et html -->
<?php
include("footer.php");
?>
