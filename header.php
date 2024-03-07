<?php
    //On démarre une nouvelle session
    session_start();
    
    //On définit une variable par defaut pour le 1er chargement de la page
    $_SESSION['userGroup'] = 'Accueil'; // à changer pour général quand il sera dans la bd
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" type="image/png" href="./assets/img/logosp.png">
    <link href="./assets/css/style.css" rel="stylesheet" type="text/css">
    <script src="./assets/main.js" defer></script>
    
</head>

<body>
    <header>
        <nav></nav>
        <div class="banner">
            <img class="logo" src="./assets/img/logosp.png " alt="">
            <h2 class="userGroup" id="userGroup">GROUP</h2>
        </div>
    </header>
    
    <form id="formulaireLocalStorage" action="" method="post">
        <input type="" name="valeurLocalStorage" id="valeurLocalStorage" />
        <input type="submit" value="Envoyer" />
    </form>

<script>
// Définir la valeur dans localStorage
// localStorage.setItem("valeur", "valeurDeLocalStorage");

// Remplir le champ caché avec la valeur de localStorage
// document.getElementById("valeurLocalStorage").value = localStorage.getItem("userGroup");

// Déclencher l'envoi du formulaire
// document.getElementById("formulaire").submit();
</script>