<?php
require 'bdd.php';
$db = Database::connect();

if(isset($_POST['id']) && isset($_POST['qte'])){
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $qte = filter_var($_POST['qte'], FILTER_VALIDATE_INT);
// Mettre à jour le panier avec la nouvelle qte 
    $stmtPanier = $db->prepare('UPDATE panier SET qte = ? WHERE id = ?');
    $successUpPanier = $stmtPanier->execute([$qte, $id]);

    // Si le panier a été mis à jour
    if($successUpPanier){

        // Récupérer l'id du produit qui est au panier 
        $stmtProdId = $db->prepare('SELECT produit_id FROM panier WHERE id = ?');
        $stmtProdId-> execute([$id]);
        $prodId = $stmtProdId->fetch(PDO::FETCH_ASSOC); 

        if($prodId){
            //  Mettre la qte en stock à jour
            $stmtProd = $db->prepare('UPDATE produits SET qte = qte - ? WHERE id = ?');
            $successUpProd = $stmtProd->execute([$qte, $prodId['produit_id']]);
        }

    }
 
}

Database::disconnect();