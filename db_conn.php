<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorial";

// Création de la connexion
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Échec de la connexion à la base de données : " . mysqli_connect_error());
}

// Pas de message constant ici
?>

