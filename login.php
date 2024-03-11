<?php
$user = null;
if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    unset($_COOKIE['user']);
    setcookie('user', '', time()-10);
}
if (!empty($_COOKIE['user'])) {
    $user = $_COOKIE['user'];
}
if (!empty($_POST['nom'])) {
    setcookie('user', $_POST['nom'], time()+3600);
    $user=$_POST['nom'];
}


if ($user): ?>
    <h2>Bonjour <?= htmlentities($user) ?></h2>
    <a href="logout.php?action=deconnecter">Se déconnecter</a><br>
<?php else: 
    include ("db.php");
    $sql = "SELECT nom FROM benevoles ORDER BY nom";
    $req = $db->prepare($sql);
    $req->execute();
    ?>
    <form action="" method="POST">
        <select name="nom" required>
            <option selected>Selectionnez votre nom</option>

            <?php while ($row = $req->fetch()) { ?>
                <option value="<?php echo $row['nom']; ?>" 
                ><?php echo $row['nom']; ?>
                </option>
            <?php } ?>
        </select>
        
        <input type="date" name="dt_nais" placeholder="Votre date de naissance" required />
        <input type="submit" value="Connexion">
<?php endif; 


?>
