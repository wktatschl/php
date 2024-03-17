<?php
require '../bdd.php';
session_start();
// Vérifier si l'utilisateur est connecté et si c'est un admin
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

$db = Database::connect();

// Récupérer tous les produits
$stmt = $db->query('SELECT * FROM produits');
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les sous-catégories
$query = "SELECT * FROM categories WHERE parent != 0";
$childCategs = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);

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
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ajouter un produit
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un produit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form action="addProdREQ.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom de produit</label>
                            <input type="text" class="form-control" id="nom" name="nom">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <input type="text" class="form-control" id="desc" name="description">
                        </div>
                        <div class="mb-3 form-check">
                            <label class="form-check-label" for="prix">Prix</label>
                            <input type="number" class="form-controlt" id="prix" name="prix">
                        </div>

                        <div class="mb-3">
                            <label for="qte" class="form-label">Quantité en stock</label>
                            <input type="number" class="form-control" id="qte" name="qte" >
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">Image du produit</label>
                            <input type="file" class="form-control" id="img" name="img" >
                        </div>

                        <div class="mb-3">
                            <label for="sscategs" class="form-label">Sous-catégories</label>
                            <select name="categ_id" id="sscategs" class="form-select">
                                <?php foreach ($childCategs as $childCateg) { ?>
                                    <option value="<?= $childCateg['id']; ?>"><?= $childCateg['nom']; ?></option>
                                <?php } ?>
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Descritpion</th>
                <th scope="col">Prix</th>
                <th scope="col">qte en stock </th>
                <th scope="col">actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit) { ?>
                <tr>
                    <th scope="row"><?= htmlspecialchars($produit['id']); ?></th>
                    <td><img src="../img/<?= htmlspecialchars($produit['img']); ?>" alt="<?= htmlspecialchars($produit['nom']); ?>" style="width:50px; height:auto"></td>
                    <td><?= htmlspecialchars($produit['nom']); ?></td>
                    <td><?= htmlspecialchars($produit['description']); ?></td>
                    <td><?= htmlspecialchars($produit['prix']); ?></td>
                    <td><?= htmlspecialchars($produit['qte']); ?></td>
                    <td>

                        <a href="edit.php?id=<?= $produit['id']; ?>" class="btn btn-primary">Modifier</a>
                        <a href="delete.php?id=<?= $produit['id']; ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>





    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>