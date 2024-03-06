<?php
session_start();
// Si mes sessions n'existent pas, on redirige vers index.php
// || -> or 
// && -> and
if(!isset($_SESSION['nomUser']) || !isset($_SESSION['prenomUser']) || !isset($_SESSION['img'])){

    // Redirection 
    header('Location: index.php');

    // permet d'arrêter l'exécution du script
    exit();
}


include('header.php');


echo "<h2>Informations utilisateur</h2>";
echo "<p>Nom : " . $_SESSION['nomUser'] . "</p>";
echo "<p>Prénom : " . $_SESSION['prenomUser'] . "</p>";
echo "<p> Image de profil: </p>";
echo "<img src='" , $_SESSION['img'] , "' alt='Image de profil' style='width: 200px; height: 200px;'>";


include('footer.php');

