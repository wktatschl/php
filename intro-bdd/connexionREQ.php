<?php
require 'bdd.php';
$db = Database::connect();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);

    // Verifier si l'user existe en bdd avec le mail
    $stmt = $db -> prepare('SELECT * FROM utilisateurs WHERE email = :email');
    $stmt -> execute(['email' => $email]);
    $user = $stmt -> fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($mdp, $user['mot_de_passe'])) {
        $_SESSION['userId'] = $user['id'];
        header('Location: index.php');
    } else {
        $error = 'Email ou mot de passe incorrect';
        header('Location: connexion.php?error=' . $error);
    }


}




Database::disconnect();