<?php
require 'bdd.php';
session_start();
if (!isset($_SESSION['userTemp'])){
  $_SESSION['userTemp'] = time();
}




$db = Database::connect();

// Récupérer toutes les categs parentes 
$query = "SELECT * FROM categories WHERE parent = 0";
// FETCH_ASSOC pour récupérer les données sous forme de tableau associatif car de base il renvoie un tableau associatif et un tableau indexé
$parentCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);


// Récupérer toutes les categs enfants
$query = "SELECT * FROM categories WHERE parent != 0";
$childCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

// Opérateur de fusion 
// $categ_id = $_GET['categ'] ?? null;
// Equivalent à : 
$categ_id = isset($_GET['categ']) ? $_GET['categ'] : null;
if (!empty($categ_id)) {
  // parametre de positionnement '?' !! on doit respecter l'ordre des paramètres
  $query = 'SELECT * FROM produits WHERE categorie_id = ?';
  $stmt = $db->prepare($query);
  $stmt->execute([$categ_id]);

  ///////////////////////// Equivalent à : parametre nommé -> plus explicite /////////////////////////
  $query= 'SELECT * FROM produits WHERE categorie_id = :categ_id';
  $stmt = $db->prepare($query);
  $stmt -> execute(['categ_id' => $categ_id]);
} else {

  $query = 'SELECT * FROM produits';
  $stmt = $db->query($query);
}
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <?php foreach ($parentCategs as $categ) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= htmlspecialchars($categ['nom']); ?>
              </a>
              <ul class="dropdown-menu">
                <?php foreach ($childCategs as $childCateg) {
                  if ($childCateg['parent'] === $categ['id']) { ?>
                    <li><a class="dropdown-item" href="index.php?categ=<?php echo htmlspecialchars($childCateg['id']); ?>"><?= htmlspecialchars($childCateg['nom']); ?></a></li>
                <?php }
                } ?>
              </ul>
            </li>
          <?php } ?>
        </ul>

        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['userId'])) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="">Profil</a></li>
                <li><a class="dropdown-item" href="">Commande</a></li>
                <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
              </ul>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link" href="panier.php">
              <i class="bi bi-bag"></i>
              <span class='badge bg-primary'>1</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <?php foreach ($produits as $produit) { ?>
        <div class="col-4">
          <div class="card" style="width: 18rem;">
            <img src="img/<?= $produit['img']; ?>" class="card-img-top" alt="<?= htmlspecialchars($produit['nom']); ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($produit['nom']); ?></h5>
              <p class="card-text"><?= htmlspecialchars($produit['description']); ?>.</p>
              <p class="card-text"><?= htmlspecialchars($produit['prix']); ?>.</p>
              <div class="d-flex justify-content-between">
                <a href="details.php?id=<?= htmlspecialchars($produit['id']); ?>" class="btn btn-primary me-1">Voir les détails</a>
                <a href="addPanierREQ.php?id=<?= htmlspecialchars($produit['id']); ?>" class="btn btn-success">Ajouter au panier</a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>






  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>