<?php
$host = "localhost";
$dbname = "spf76";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    echo "Connexion réussie ! <br><br>";
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        }
?>
