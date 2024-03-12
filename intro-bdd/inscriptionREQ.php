<?php
require 'bdd.php';
$db = Database::connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $stmt = $db->prepare('SELECT id FROM utilisateurs WHERE email = :mail');
    $stmt->execute(['mail => $mail']);
    if ($stmt->fetch()) {
        $error = 'Cet email est déja utilisé';
        header('Location: inscription.php?error=' . $error);
        exit;
    }

    // Hasher un mot de passe
    // la fonction password_hash() effectue le 'salage' automatiquement
    // Un sel est une chaine de caracteres qui est ajoutee au mot de passe avant le hachage. Cela rend le hashage unique même si le mdp est utilise par plusieurs users
    // Permet de protéger contre les attaques par rainbow table (table de hachage)

    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    $stmt = $db->prepare('INSERT INTO utilisteurs (nom, mail, mot_de_passe) VALUES (:nom, :mail, :mdp)');
    $success = $stmt->execute(['nom' => $nom, 'mail' => $mail, 'mdp' => $mdp]);

    if ($success) {
        header('Location: connexion.php');
    } else {
        $error = 'Erreur lors de l\'inscription';
        header('Location: inscription.php?error=' . $error);
    }
}


Database::disconnect();

?>