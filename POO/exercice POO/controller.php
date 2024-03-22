<?php


require "MonPDO.class.php";
require "Animal.class.php";
require "AnimalDAO.class.php";

$animaux = AnimalDAO::getAnimauxBD();

foreach($animaux as $animal){
    $id = htmlspecialchars($animal['idAnimal']);
    $nom =  htmlspecialchars($animal['nom']);
    $age =  htmlspecialchars($animal['age']);
    $sexe =  htmlspecialchars($animal['sexe']);
    $type = AnimalDAO::getTypeAnimal($id);
    $image = AnimalDAO::getImagesAnimal($id);
    new Animal($id, $nom, $age, $sexe, $type, $image);
}