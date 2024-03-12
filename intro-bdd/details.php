<?php
require 'bdd.php';


$db = Database::connect();

if(isset($_GET['id']) && is_numeric($_GET['id'])){
  $id = htmlspecialchars($_GET['id']);
  $query = 'SELECT * FROM produits WHERE id = :id';
  $stmt = $db->prepare($query);
  $stmt -> execute(['id' =>$id]);
  $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}



Database::disconnect();

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>e-commerce test </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    
<div class="container">
    <div class="row">
      <div class="col-4">
        <div class="card" style="width: 18rem;">
          <img src="img/<?= $produit['img']; ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['nom']); ?>">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($produit['nom']); ?></h5>
            <p class="card-text"><?= htmlspecialchars($produit['description']); ?>.</p>
            <p class="card-text"><?= htmlspecialchars($produit['prix']); ?>.</p>
            <p class="card-text"><?= htmlspecialchars($produit['qte']); ?>.</p>
            <a href="details.php?id=<?= htmlspecialchars($produit['id']);?>" class="btn btn-primary">Voir les détails</a>
          </div>
        </div>
      </div>
    </div>
  </div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>