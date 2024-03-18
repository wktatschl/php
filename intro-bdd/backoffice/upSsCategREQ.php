<?php
require '../bdd.php';
$db = Database::connect();

$categId = filter_var($_POST['categId'], FILTER_VALIDATE_INT);
if(!empty(trim($_POST['nom']))){

    $stmt = $db->prepare('UPDATE categories SET nom = ? WHERE id = ?');
    if($stmt->execute([$_POST['nom'], $_POST['subCategId']])){
        header('Location: ssCateg.php?id=' . $categId);

    }else{
        echo "Erreur lors de la modification";
        exit();
    }
}