<?php
require 'bdd.php';

$db = Database::connect();

if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $query = 'SELECT * FROM produits WHERE id = :id';
    $stmt = $db->prepare($query);
    $stmt -> execute(['id' =>$id]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);
}

$filteredProducts = [];

Database::disconnect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

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