<?php
session_start();


// Vérifier si la méthode d'enregistrement est POST
if($_SERVER["REQUEST_METHOD"] == "POST"){



    // $_POST['nom'] - fait réfrérence à l'attribut name de notre input, $_POST fait référence à la méthode de notre formulaire
    $_SESSION['nomUser'] = htmlspecialchars($_POST['nom']);
    $_SESSION['prenomUser'] = htmlspecialchars($_POST['prenom']);




    // Télécharger une image

    $file = "uploads/" . basename($_FILES["img"]["name"]);



    
    // Vérifier si le fichier existe déjà
    if(move_uploaded_file($_FILES["img"]["tmp_name"], $file)){

        //  Enregistrer le nom du fichier dans la session
        $_SESSION['img'] = $file;
      
    } else {
        echo "Désolé, il y a eu une erreur lors du téléchargement de votre fichier.";
    }

    header('Location: affichage.php');
    exit();


}
