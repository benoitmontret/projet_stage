<?php
$host = "localhost";
$dbname = "spf76";
$username = "root";
$password = "root";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // echo "<h6>Connexion réussie !</h6> <br>";
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        }
?>
