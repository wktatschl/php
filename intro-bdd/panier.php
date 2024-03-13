<?php
require 'bdd.php';
session_start();
 $db = Database::connect();
 $userTemp = $_SESSION['userTemp'] ?? null;
 $userId = $_SESSION['userId'] ?? null;

 if(!empty($userId)){
   $query = 'SELECT panier.*, produits.nom, produits.prix 
             FROM panier
             INNER JOIN  produits ON panier.produit_id = produits.id
             WHERE user_id = ?';
   $stmt = $db->prepare($query);
   $stmt->execute([$userId]);
   $panier = $stmt->fetchAll(PDO::FETCH_ASSOC);
 }else{
    $query = 'SELECT pa.*, p.nom, p.prix 
              FROM panier pa
              INNER JOIN  produits p ON pa.produit_id = p.id 
              WHERE userTemp = ? AND user_id IS NULL';
    $stmt = $db->prepare($query);
    $stmt->execute([$userTemp]);
    $panier = $stmt->fetchAll(PDO::FETCH_ASSOC);

}
$totalPanier=0 ;


//  Nom du produit 
//  qte au panier 
//  prix produit 
//  prix total = prix produit * qte panier 


 Database::disconnect();


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-commerce test </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

</head>

<body>

    <h2>Votre Panier</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Produit</th>
      <th scope="col">Quantité</th>
      <th scope="col">Prix unitaire</th>
      <th scope="col">Prix total</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($panier as $item): ?>
        
    <tr>
      <th scope="row"><?= htmlspecialchars($item['nom']); ?></th>
      <td>
          <button class='btn btn-secondary btn-sm changeQte' data-id="<?= $item['id']; ?>" data-action="decrease">-</button>
          <span><?= htmlspecialchars($item['qte']); ?></span>
          <button class='btn btn-secondary btn-sm changeQte' data-id="<?= $item['id']; ?>" data-action="increase">+</button>
    </td>
      <td><?= htmlspecialchars($item['prix']); ?>€</td>
      <td><?= $item['prix'] * $item['qte']; ?>€</td>
      <td>
        <button class="btn btn-danger">Supprimer</button>
      </td>
    </tr>
    <?php $totalPanier += $item['prix'] * $item['qte']; ?>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="3">Total panier:</th>
      <td><?= $totalPanier; ?>€</td>
      <!-- <td>
        <button class="btn btn-success">Valider le panier</button>
      </td> -->
    </tr>
  </tfoot>
</table>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  <script>
    // On récupère tous les boutons de changement de quantité
    document.querySelectorAll('.changeQte').forEach(btn => {
        //  On crée un écouteur d'événement sur chaque bouton
        btn.addEventListener('click', () => {
            let action = this.dataset.action 
            let id = this.dataset.id
            // On récupère le tr sur lequel se trouve le span
            let row = this.closest('tr')
            let qteEle = row.querySelector('span')
            // On récupère la qte 
            let newQte = parseInt(qteEle.textContent)

            if(action === 'increase'){
                newQte++
            }
            if(action === 'decrease' && newQte > 1){
                newQte--
            }

            // qteEle.textContent = newQte

            // On créer unerequête asynchrone pour mettre à jour la qte en bdd
            fetch('upQteREQ.php', {
                // method : comment on envoie les données
                method: 'POST',
                // headers  sous quelle forme on envoie les données
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                // Les données qu'on envoie
                body: `id=${id}&qte=${newQte}`
            })

            // Réagir à la réponse
            .then(response => response.text())
            .then(data => {
                    if(data.trim() === 'success'){
                        qteEle.textContent = newQte

                    }else{
                        console.log("Erreur")
                    }
            })      



        })

    })


  </script>
</body>

</html>