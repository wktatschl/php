<?php
require 'bdd.php';
session_start();

$db= Database::connect();

// Récupérer toutes les categs parentes 
$query = "SELECT * FROM categories WHERE parent = 0";
// FETCH_ASSOC pour récupérer les données sous forme de tableau associatif car de base il renvoie un tableau associatif et un tableau indexé
$parentCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


// Récupérer toutes les categs enfants
$query = "SELECT * FROM categories WHERE parent != 0";
$childCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM produits";
$products = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

$filteredProducts = [];

if (isset($_GET['category'])) {
    $selectedCategory = urldecode($_GET['category']);

    foreach ($products as $product) {
        foreach ($childCategs as $childCateg) {
            if ($childCateg['nom'] === $selectedCategory && $product['categorie_id'] === $childCateg['id']) {
                $filteredProducts[] = $product;
            }
        }
    }
} else {
    $filteredProducts = $products;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce test </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php foreach($parentCategs as $categ) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= htmlspecialchars($categ['nom']); ?>
            </a>
            <ul class="dropdown-menu">
              <?php foreach($childCategs as $childCateg) { 
                  if ($childCateg['parent'] === $categ['id']){?>
              <li><a class="dropdown-item" href="?category=<?= urlencode($childCateg['nom']); ?>"><?= htmlspecialchars($childCateg['nom']); ?></a></li>
              <?php }
          } ?>
            </ul>
          </li>
          <?php } ?>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="inscription.php">Inscription</a>
          </li>
          <li>
            <a class="nav-link" href="inscription.php">Connexion</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>

<h1>
    <?php
    if (isset($_GET['category'])) {
        echo htmlspecialchars(urldecode($_GET['category']));
    } else {
        echo 'produits';
    }
    ?>
</h1>
<div class="product-list-container">
    <?php foreach($filteredProducts as $product) {
     ?>
        <div class="card" style="width: 18rem;">
        <img src="img/<?= $product['img']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($product['nom']); ?></h5>
            <p class="card-text">€ <?= htmlspecialchars($product['prix']); ?></p>
            <p class="card-text"><?= htmlspecialchars($product['description']); ?></p>
            <a href="details.php?id=<? htmlspecialchars($product['id'])?>" class="btn btn-primary">Voir les détails</a>
            
        </div>
        </div>
    <?php } ?>
</div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>