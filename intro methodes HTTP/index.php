<?php 
include('header.php');

$prenom = 'Franck';
$nom = 'DUCODE';

?>

<a href="apropos.php?prenom=<?php echo urlencode($prenom); ?>&nom=<?php echo urlencode($nom); ?>">Cliquez ICI </a>



<?php 
include('footer.php');

?>