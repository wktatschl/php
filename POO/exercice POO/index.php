<?php
ob_start();
require 'controller.php';
$titre = "Liste des animaux";
?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Age</th>
      <th scope="col">Sexe</th>
      <th scope="col">Type</th>
      <th scope="col">Images</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach(Animal::$mesAnimaux as $animal){ ?>
    <tr>
      <th scope="row"><?= $animal->getId(); ?></th>
      <td><?= $animal->getNom(); ?></td>
      <td><?= $animal->getAge(); ?> ans</td>
      <td><?= ($animal->getSexe() === 0) ? "Femelle" : "Mâle"; ?></td>
      <td><?= $animal->getType(); ?></td>
      <td>
        <?php foreach($animal->getImages() as $image){ ?>
            <img src="sources/<?= $image['url'];?>" alt="<?= $image['libelle']; ?>" style="max-height:150px" class="img-thumbnail">
        <?php } ?>
      </td>
    </tr>

    <?php } ?>
  </tbody>
</table>

<?php
$content = ob_get_clean();
require 'template.php';
?>