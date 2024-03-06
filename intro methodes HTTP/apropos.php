<?php 
include('header.php');

// isset  - Déterminer si une variable est déclarée et est différente de NULL 
// htmlspecialchars - Convertit les caractères spéciaux en entités HTML
$prenom2 = isset($_GET['prenom']) ? htmlspecialchars($_GET['prenom']) : 'Inconnu';

// empty - Déterminer si une variable est vide
// strip_tags - Supprime les balises HTML et PHP d'une chaîne
//htmlentities - Convertit tous les caractères éligibles en entités HTML
$nom2 = !empty($_GET['nom']) ? strip_tags($_GET['nom']) : 'Inconnu';

?>

<h2>A propos</h2>
<p>Prénom : <?php echo $prenom2; ?></p>
<p>Nom : <?php echo $nom2; ?></p>



<?php 
include('footer.php');

?>