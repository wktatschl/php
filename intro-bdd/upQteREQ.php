<?php
require 'bdd.php';
$db = Database::connect();

if(isset($_POST['id']) && isset($_POST['qte'])){
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $qte = filter_var($_POST['qte'], FILTER_VALIDATE_INT);

    if (filter_var($qte, FILTER_VALIDATE_INT) && $qte > 0) {

        $stmt = $db->prepare('SELECT * FROM panier WHERE id = ?');
        $stmt->execute([$id]);
        $panier = $stmt->fetch(PDO::FETCH_ASSOC);
        if($panier) {
            $qteActuelle = $panier['qte'];
            $produitId = $panier['produit_id'];

            $stmt = $db->prepare('SELECT * FROM produits WHERE id = ?');
            $stmt->execute([$produitId]);
            $produit = $stmt->fetch(PDO::FETCH_ASSOC);

            if($produit && $produit['qte'] >= $qte) {

                $stmt = $db->prepare('UPDATE panier SET qte = ? WHERE id = ?');
                $successUpPanier = $stmt->execute([$qte, $prodId]);

                if($successUpPanier) {

                    $diff = $qte - $panier['qte'];

                    $stmtProd = $db->prepare('UPDATE produits SET qte = qte - ? WHERE id = ?');
                    $successUpProd = $stmtProd->execute([$qte, $panier['produit_id']]);

                    if ($successUpProd) {
                        echo 'success';
                    } else {
                        echo 'erreur';
                    }

                } else {
                    echo 'erreur';
                }
            } else {
                echo 'erreur';
            }
        } else {
            echo 'erreur';
        }
    } else {
        echo 'erreur';
    }
 
} else {
    echo 'erreur';
}

Database::disconnect();