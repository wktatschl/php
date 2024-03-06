<?php 
include('header.php');


?>

<!--  !!!  l'attribut enctype="multipart/form-data" est nécéssaire lorsqu'on souhaite télécharger une image ou un fichier  -->
<form action="traitement.php" method="POST" enctype="multipart/form-data">
<label for="nomid">Nom:</label>
<!-- Name est important pour pouvoir récupérer nos données de l'autre coté  -->
<input type="text" id="nomid" name="nom" required>


<label for="prenomid">Prénom:</label>
<input type="text" id="prenomid" name="prenom" required>

<label for="imgid"></label>
<input type="file" id="imgid" name="img" accept="image/*" required>

<button type="submit">Envoyer le formulaire</button>

</form>


<?php 
include('footer.php');

?>